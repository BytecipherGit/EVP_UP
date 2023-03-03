<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use Session;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $document=Documents::where('user_id',Auth::id())->first();
        return view('company/company-verification-document',compact('document'));
    }

    public function getDocument(request $request){

        if(Auth::check()){
            $user_id=Auth::id();   
        }
   
        $data = new Documents();

    
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
     
   
      $data->save();

      $document=Documents::where('user_id',Auth::id())->first();

      if($document->status == 'pending'){
        Auth::logout();
        Session::flush();	  
        return redirect('status');
            }
            else{
        return redirect('admin');
    }
}
}