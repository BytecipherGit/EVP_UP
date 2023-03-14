<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            if(count($checkDocuments) > 0){
                $flagStatus = true;
                foreach($checkDocuments as $row){
                    if($row->status == 'pending'){
                        $flagStatus = false;
                    } else {
                        $flagStatus = true;
                    }
                }
                if(!$flagStatus){
                    return redirect('company/company-verification-document')->with('message', 'Your document is under varification! You will be able to sign in shortly');
                } else {
                    return view('company/company-verification-document', compact('document'));
                }
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
                'reg_id' => 'required|string|max:255',
                'gst' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:2048',
                'pancard' => 'required|file|mimes:jpeg,png,pdf,docs,doc|max:2048',
            ], [
                'reg_id.required' => 'Registration number is must.',
                'reg_id.min' => 'Registration number not more then 255 character.',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }

            if (Auth::check()) {
                if ($request->hasFile('gst')) {
                    $gstFile = $request->file('gst');
                    $gstFileName = time() . '_' . $gstFile->getClientOriginalName();
                    $gstFile->storeAs('public/company_documents/gst', $gstFileName);
                    $gstUploadFilePath = asset('storage/company_documents/gst/' . $gstFileName);
                    $insertGSTRecords = [
                        'reg_id' => !empty($request->reg_id) ? $request->reg_id : null,
                        'user_id' => Auth::id(),
                        'doc_type' => 'GST',
                        'document' => !empty($gstUploadFilePath) ? $gstUploadFilePath : null,
                    ];
                    Documents::create($insertGSTRecords);
                }
                if ($request->hasFile('pancard')) {
                    $pancardFile = $request->file('pancard');
                    $pancardFileName = time() . '_' . $pancardFile->getClientOriginalName();
                    $pancardFile->storeAs('public/company_documents/pancard', $pancardFileName);
                    $pancardUploadFilePath = asset('storage/company_documents/pancard/' . $pancardFileName);
                    $insertpancardRecords = [
                        'reg_id' => !empty($request->reg_id) ? $request->reg_id : null,
                        'user_id' => Auth::id(),
                        'doc_type' => 'Pan Card',
                        'document' => !empty($pancardUploadFilePath) ? $pancardUploadFilePath : null,
                    ];
                    Documents::create($insertpancardRecords);
                }
                return redirect()->back()->with('message', 'Your document is under varification! You will be able to sign in shortly');
            } else {
                return redirect('admin');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        /*$data = new Documents();
        $data->reg_id= $request->input('reg_id');
        $data->user_id=$user_id;
        $data->doc_type=json_encode($request->doc_type);
        $data->document=json_encode($request->document);
        $document =[];
        if($request->hasfile('document')){
        foreach($request->file('document') as $file){
        $filename = $file->getClientOriginalName();
        $file->move(public_path().'/Image/',$filename);
        $document[] = $filename;
        }
        $data->document=json_encode($document);
        }
        $data->save();*/

        // $document = Documents::where('user_id', Auth::id())->first();

        // if ($document->status == 'pending') {
        //     Auth::logout();
        //     Session::flush();
        //     return redirect('status');
        // } else {
        //     return redirect('admin');
        // }
    }
}
