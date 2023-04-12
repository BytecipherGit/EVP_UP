<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyTemplate;
use App\Models\CompanyEmailTemplate;
use Auth;

class CompanyEmailTemplatesController extends Controller
{
  

        public function createQualifiedEmail() {
            $templateQualified = CompanyTemplate::join('company_email_templates','company_email_templates.template_id','=','company_templates.id')
            ->where('company_email_templates.company_id',Auth::id())->where('company_email_templates.email_type', 'Qualified')->first();
            return view("admin/CompanyTemplate/template-for-qualified",compact('templateQualified'));
        }
 
  
        public function createNotQualifiedEmail() {
            $templateNotQualified = CompanyTemplate::join('company_email_templates','company_email_templates.template_id','=','company_templates.id')
            ->where('company_email_templates.company_id',Auth::id())->where('company_email_templates.email_type', 'NotQualified')->first();
            return view("admin/CompanyTemplate/template-for-not-qualified",compact('templateNotQualified'));
        }
 
       public function updateQualifiedTemplate(Request $request) {
         $templateQualified = CompanyTemplate::join('company_email_templates','company_email_templates.template_id','=','company_templates.id')
                              ->where('company_email_templates.company_id',Auth::id())->where('company_email_templates.email_type', 'Qualified')->first();

        if(empty($templateQualified)){
            $templatePost = [  
                        'company_id' => Auth::id(),
                        'email_type' => 'Qualified',
                        "content" =>  !empty($request->content) ? $request->content : null,
                    ];
               $templatePost  =  CompanyTemplate::create($templatePost);

         }
         else {
            CompanyEmailTemplate::where('company_id',$templateQualified->company_id)->where('email_type', 'Qualified')
               ->update([
                        "content" => !empty($request->content) ? $request->content : null,
              ]);
              
         }
         return back()->with("success", "Template has been created");
    }

    public function updateNotQualifiedTemplate(Request $request)
    {

        $template = CompanyTemplate::join('company_email_templates','company_email_templates.template_id','=','company_templates.id')
                    ->where('company_email_templates.company_id',Auth::id())->where('company_email_templates.email_type', 'NotQualified')->first();

        if(empty($template)){
            $templatePost = [  
                        'company_id' => Auth::id(),
                        'email_type' => 'NotQualified',
                        "content" =>  !empty($request->content) ? $request->content : null,
                    ];
              $templatePost  =  CompanyTemplate::create($templatePost);

         }
         else {
            CompanyEmailTemplate::where('company_id',$template->company_id)->where('email_type', 'NotQualified')->update([
                        "content" => !empty($request->content) ? $request->content : null,
              ]);    
         } 
         
         return back()->with("success", "Template has been created");
    }

}
