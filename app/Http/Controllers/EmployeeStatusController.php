<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Response;
use App\Mail\SendOfferMailToEmployee;
use App\Models\EmployeeInterview;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Helpers\Helper as HelpersHelper;
use Illuminate\Support\Facades\Config;
use Auth;
use App\Models\EmployeeStatus;

class EmployeeStatusController extends Controller
{

    public function index(request $request)
    { 
    
        $employeeOfferData = EmployeeStatus::where('employee_offer_statuses.company_id',Auth::id())->get();

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


    public function update_send_offer_status(request $request)
    {
        if (!empty($request->sendOfferId) && !empty($request->offerStatus)) {
           
            $offerSend = EmployeeStatus::find($request->sendOfferId);

            $offerSend->status = $request->offerStatus;

            if ($offerSend->save()) {
                return Response::json(['success' => '1']);
            } else {
                return Response::json(['success' => '0']);
            }
        } else {
            return Response::json(['success' => '0']);
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

            if(!empty($employeeOfferStatusData)){
                $updateInterviewEmp = DB::table('interview_employees')->where('employee_id', $employeeOfferStatusData->employee_id)->where('company_id',Auth::id())
            ->update([
                'employee_offer_id' => $employeeOfferStatusData->id,
            ]);

            }

            $employeeExist = EmployeeInterview::where('employee_id', $request->employee_id)->where('company_id',Auth::id())->first();

        if (!empty($employeeExist)) {

            if (!empty($employeeOfferStatusData->email) && !empty($employeeOfferStatusData)) {

                $mailData = [
                    'company_id' => Auth::id(), 
                    'employee_id' => !empty($request->employee_id) ? $request->employee_id : null,
                    'name' => !empty($request->name) ? $request->name : null,
                    'email' => !empty($request->email) ? $employeeExist->email : null,
                    // 'companyName' => !empty($request->org_name) ? $employeeExist->org_name : null,
                    'EmployeeOfferId' => encrypt($employeeOfferStatusData->id), 
                ];

                $emailDetails = HelpersHelper::getSmtpConfig(Auth::id());

                $config = array(
                    'driver'     => $emailDetails->driver,
                    'host'       => $emailDetails->host,
                    'port'       => $emailDetails->port,
                    'from'       => array('address' => $emailDetails->from_address, 'name' => $emailDetails->from_name),
                    'encryption' => $emailDetails->encryption,
                    'username'   => $emailDetails->username,
                    'password'   => $emailDetails->password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);

               FacadesMail::to($employeeOfferStatusData->email)->send(new SendOfferMailToEmployee($mailData));
            }
         }
            return Response::json(['success' => '1']);

            } else {
             return Response::json(['success' => '0']);
         }     
      }

   }


   public function offerSendAcceptStatus(request $request)
   {
// dd($request->EmployeeOfferId);
       if (!empty($request->EmployeeOfferId)) {
           $id = decrypt($request->EmployeeOfferId);
           $offerData = EmployeeStatus::where('id', $id)->first();
           if ($offerData) {
               if (($offerData->status != 'Accepted') && ($offerData->status == 'Offer Sent')) {
                   $changeStatus = DB::table('employee_offer_statuses')->where('id', $id)
                       ->update([
                           'status' => 'accepted',
                       ]);
                  if ($changeStatus) {
                   return redirect('/success');
                  }
               } else {
                return redirect('/response_submited');
               }
           } else {
               return Response::json(['success' => '0']);
           }
       }
   }

   public function  createOfferDeclinedFromMail(request $request)
   {
    // dd($request->all());
       if (!empty($request->employeeOfferId)) {
        //    $id = decrypt($request->employeeOfferId);
           $offerData = EmployeeStatus::where('id', $request->employeeOfferId)->first();
        //    dd($offerData->status);
           if (!empty($offerData)) {
               if (($offerData->status != 'Declined') && ($offerData->status == 'Offer Sent')) {
                   $changeStatus = DB::table('employee_offer_statuses')->where('id', $request->employeeOfferId)
                       ->update([
                          'declined_comment' => $request->input('declined_comment'),
                           'status' => 'declined',
                       ]);
                    if ($changeStatus) {
                        return redirect('/success');
                    }
               } else {
                  return redirect('/response_submited');
               }

           } else {
               return Response::json(['success' => '0']);
           }
       }
   }

   public function offerSendDeclineStatus(request $request)
     {
        if (!empty($request->EmployeeOfferId)) {
            $employeeOfferId = decrypt($request->EmployeeOfferId);
            $employeofferdecline = DB::table('employee_offer_statuses')
                ->join('interview_employees', 'interview_employees.employee_id', '=', 'employee_offer_statuses.employee_id')
                ->join('users', 'interview_employees.company_id', '=', 'users.id')
                ->select('employee_offer_statuses.*','users.org_name', 'interview_employees.position')
                ->where('employee_offer_statuses.id', $employeeOfferId)
                ->first();
                // dd($employeofferdecline);
            if ($employeofferdecline) {
                return view('admin/emails/candidate/employee_offer_declined', compact('employeofferdecline', 'employeeOfferId'));
            } else {
                return Response::json(['success' => '0']);
            }
        }

    }
   
}