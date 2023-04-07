<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\Models\Employee;

class SearchController extends Controller
{

    public function index(){
        return view('admin/search-history');
    }
    // public function search(){

    // }

    public function search(Request $request)
    {
        if ($request->get('search')) {
        $output = "";
        $employees =  Employee::select(DB::raw("CONCAT(first_name,' ', last_name) as value"), "id","current_address")
                        ->where('first_name', 'LIKE', '%'. $request->get('search'). '%')
                        ->get();
    
            if(!empty($employees) || !blank($employees) ) {
                foreach($employees as $key => $employee){

                    $output.=' <div class="search-hist-page">
                                <div class="search-hist-pro">
                                <h2>'.$employee->value.'
                                    <span>React native developer at ByteCipher Private Limited.</span>   
                                    <small>'.$employee->current_address.'</small> 
                                    <small>4.5 <span>reviews</span></small> 
                                    <span class="d-flex">
                                    </span>     
                                </h2>
                                </div>  
                            </div>';
                      }
                 } 
                 else {
                    $output.='<div class="search-hist-page">
                    <div class="search-hist-pro">
                    <h2>Recored dose not exist </h2>
                      </div>  
                </div>';
              } 
           return Response::json(['success' => true, 'value' => $output]);
        }
        else{
            return Response::json(['success' => false]);
        }
    }
}
