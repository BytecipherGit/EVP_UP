<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterviewTemplate;
use Auth;

class EmailTemplatesController extends Controller
{
  
        public function createQualifiedEmail() {

            $templateQualified = InterviewTemplate::where('company_id',Auth::id())->where('email_type', 'Qualified')->first();
            return view("admin/interviewTemplate/template-for-qualified",compact('templateQualified'));
        }
 
  
        public function createNotQualifiedEmail() {
            $templateNotQualified = InterviewTemplate::where('company_id',Auth::id())->where('email_type', 'Not Qualified')->first();
            return view("admin/interviewTemplate/template-for-not-qualified",compact('templateNotQualified'));
        }
 
       public function store(Request $request) {
         $templateQualified = InterviewTemplate::where('company_id',Auth::id())->where('email_type', 'Qualified')->first();

        if(empty($templateQualified)){
            $templatePost = [  
                        'company_id' => Auth::id(),
                        'email_type' => 'Qualified',
                        "content" =>  !empty($request->content) ? $request->content : null,
                    ];
               $templatePost  =  InterviewTemplate::create($templatePost);

         }
         else {
            InterviewTemplate::where('company_id',$templateQualified->company_id)->where('email_type', 'Qualified')
               ->update([
                        "content" => !empty($request->content) ? $request->content : null,
              ]);
              
         }
         return back()->with("success", "Template has been created");
    }

    public function upload(Request $request)
    {

        $template = InterviewTemplate::where('company_id',Auth::id())->where('email_type', 'Not Qualified')->first();

        if(empty($template)){
            $templatePost = [  
                        'company_id' => Auth::id(),
                        'email_type' => 'Not Qualified',
                        "content" =>  !empty($request->content) ? $request->content : null,
                    ];
              $templatePost  =  InterviewTemplate::create($templatePost);

         }
         else {
            InterviewTemplate::where('company_id',$template->company_id)->where('email_type', 'Not Qualified')->update([
                        "content" => !empty($request->content) ? $request->content : null,
              ]);    
         } 
         
         return back()->with("success", "Template has been created");
    }

}
