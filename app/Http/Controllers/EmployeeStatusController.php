<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Response;
use App\Mail\SendOfferMailToEmployee;
use App\Models\EmployeeInterview;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Models\EmployeeStatus;

class EmployeeStatusController extends Controller
{

    public function index(request $request)
    { 
    
        $employeeOfferData = EmployeeStatus::where('company_id',Auth::id())->select('employee_id','name','email','phone')->get();
        return view('admin.employee-offer-send-details',compact('employeeOfferData'));
    }

    public function getOfferSendForm($id = '')
    { 
       if (Auth::check()) {
           $employee = Employee::where('id',$id)->first();
           $offerSendRecord = EmployeeStatus::where('employee_id', $id)->where('company_id',Auth::id())->first();

           return view('admin.offer_send-form',compact('employee','offerSendRecord'));
       }
    }

    public function createOfferSendForm(request $request)
    {

     if (Auth::check()) {

        $uploadDocument ='';
        $company_name = User::where('id', Auth::id())->first();
        $name = $company_name->org_name;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileTrim = str_replace(" ", "-", $name);
            $file->storeAs('public/' . $fileTrim . '/offer_send_document', $fileName);
            $uploadDocument = asset('storage/' . $fileTrim . '/offer_send_document/' . $fileName);
        }

        $checkRecordExist = EmployeeStatus::where('employee_id', $request->employee_id)->where('company_id',Auth::id())->first();
        
        if (empty($checkRecordExist)) {
          
            $createemployeeofferstatus = [
                'company_id' => Auth::id(), 
                'employee_id' => !empty($request->employee_id) ? $request->employee_id : null,
                'name' => !empty($request->name) ? $request->name : null,
                'email' => !empty($request->email) ? $request->email : null,
                'phone' => !empty($request->phone) ? $request->phone : null,
                'comment' => !empty($request->comment) ? $request->comment : null,
                'document' => $uploadDocument,  
            ];
         
            $employeeOfferStatusData = EmployeeStatus::create($createemployeeofferstatus);

            $employeeExist = EmployeeInterview::where('employee_id', $request->employee_id)->where('company_id',Auth::id())->first();

        if (!empty($employeeExist)) {

            if (!empty($employeeOfferStatusData->email) && !empty($employeeOfferStatusData)) {

                $mailData = [
                    'company_id' => Auth::id(), 
                    'employee_id' => !empty($request->employee_id) ? $request->employee_id : null,
                    'name' => !empty($request->name) ? $request->name : null,
                    'email' => !empty($request->email) ? $employeeExist->email : null,
                    'EmployeeOfferId' => encrypt($employeeOfferStatusData->id), 
                ];
               FacadesMail::to($employeeOfferStatusData->email)->send(new SendOfferMailToEmployee($mailData));
            }
         }
            return Response::json(['success' => '1']);

            } else {
             return Response::json(['success' => '0']);
         }     
      }

   }

   public function offerSendStatusVerification(request $request)

   {
        dd($request->all());
    if (!empty($request->id)) {
        $id = decrypt($request->id);
        // $companyData = User::where('id', $id)->first();
        $employeeExist = EmployeeInterview::where('employee_id', $request->employee_id)->where('company_id',Auth::id())->first();
        if ($companyData) {
            if ($companyData->status == '0') {
                $changeStatus = DB::table('users')->where('id', $id)
                    ->update([
                        'status' => '1',
                    ]);
                return view('admin/emails/candidate/verification-success', compact('companyData', 'id'));
            } else {
                return view('admin/emails/candidate/already-verify', compact('companyData', 'id'));
            }
        } else {
            return Response::json(['success' => '0']);
        }
    }
 }

}