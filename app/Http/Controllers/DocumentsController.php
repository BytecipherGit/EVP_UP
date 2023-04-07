<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class DocumentsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $checkDocuments = Documents::where('user_id', Auth::id())->get();
            if (count($checkDocuments) > 0) {
                $flagStatus = true;
                foreach ($checkDocuments as $row) {
                    if ($row->status == 'pending') {
                        $flagStatus = false;
                    } else {
                        $flagStatus = true;
                    }
                }
                if (!$flagStatus) {
                    return view('company/company-verification-document')->with('message', 'Thank you for uploading verification documents. Once verified then you will be able to use this portal.');
                } else {
                    return view('company/company-verification-document');
                }
            } else {
                return view('company/company-verification-document');
            }
        } else {
            Auth::logout();
            Session::flush();
            return redirect('admin');
        }

    }

    public function store(request $request)
    {
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id_proof' => 'required|file|mimes:jpeg,pdf,docs,doc|max:2048',
                'address_proof' => 'required|file|mimes:jpeg,pdf,docs,doc|max:2048',
                'document_proof' => 'required|file|mimes:jpeg,pdf,docs,doc|max:2048',
            ]
                //  [
                //     'reg_id.required' => 'Registration number is must.',
                //     'reg_id.min' => 'Registration number not more then 255 character.',
                // ]
            );
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }

            if (Auth::check()) {

                if ($request->hasFile('id_proof')) {
                    $idFile = $request->file('id_proof');
                    $idFileName = time() . '_' . $idFile->getClientOriginalName();
                    $idFile->storeAs('public/company_documents/id_proof', $idFileName);
                    $idUploadFilePath = asset('storage/company_documents/id_proof/' . $idFileName);
                    $insertIdRecords = [
                        // 'reg_id' => !empty($request->reg_id) ? $request->reg_id : null,
                        'user_id' => Auth::id(),
                        'doc_type' => 'Id Proof',
                        'document' => !empty($idUploadFilePath) ? $idUploadFilePath : null,
                    ];
                    Documents::create($insertIdRecords);
                }

                if ($request->hasFile('address_proof')) {
                    $addressFile = $request->file('address_proof');
                    $addressFileName = time() . '_' . $addressFile->getClientOriginalName();
                    $addressFile->storeAs('public/company_documents/address_proof', $addressFileName);
                    $addressUploadFilePath = asset('storage/company_documents/address_proof/' . $addressFileName);
                    $insertAddressRecords = [
                        // 'reg_id' => !empty($request->reg_id) ? $request->reg_id : null,
                        'user_id' => Auth::id(),
                        'doc_type' => 'Address Proof',
                        'document' => !empty($addressUploadFilePath) ? $addressUploadFilePath : null,
                    ];
                    Documents::create($insertAddressRecords);
                }
                if ($request->hasFile('document_proof')) {
                    $docFile = $request->file('document_proof');
                    $docFileName = time() . '_' . $docFile->getClientOriginalName();
                    $docFile->storeAs('public/company_documents/document_proof', $docFileName);
                    $docUploadFilePath = asset('storage/company_documents/document_proof/' . $docFileName);
                    $insertDocRecords = [
                        // 'reg_id' => !empty($request->reg_id) ? $request->reg_id : null,
                        'user_id' => Auth::id(),
                        'doc_type' => 'Document Proof',
                        'document' => !empty($docUploadFilePath) ? $docUploadFilePath : null,
                    ];
                    Documents::create($insertDocRecords);
                }
                return redirect('status')->with('message', 'Thank you for uploading verification documents. Once verified then you will be able to use this portal.');
                // return redirect()->back()->with('message', 'Thank you for uploading verification documents. Once verified then you will be able to use this portal.');
            } else {
                return redirect('admin');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function demoSearch()
    {
        return view('searchDemo');
    }

    public function getEmployeeNameThroughAutocomplete(Request $request)
    {
        // $data = User::select("name as value", "id")
        //             ->where('name', 'LIKE', '%'. $request->get('search'). '%')
        //             ->get();
        $data = Employee::select(DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name) as value"), "id")
                    ->where('first_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($data);
    }

    public function getEmployeeDetailsForScheduleInterview(Request $request)
    {
        $data = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as value"),"employee.*")
                    ->where('first_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($data);
    }
}
