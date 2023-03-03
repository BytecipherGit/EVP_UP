<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class CsvController extends Controller
{
    public function showForm()
    {
        return view('admin/csvfile');
    }

    public function store(Request $request)
    {   
        //get file check has
        if ($request->has('upload-file')) {
        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');

        $header= fgetcsv($file);

        // dd($header);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => &$value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]_[ ]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
            {
                continue;
            }
            //trim data
            foreach ($columns as $key => &$value) {
                $value=preg_replace('/\D/','',$value);
            }
          
           $data= array_combine($escapedHeader, $columns);
           dd($columns);
           // setting type
           foreach ($data as $key => $value) {
            $value=($key=="role" || $key=="pin")?(string)$value: (integer)$value;
           }
           $email=$data['name'];
           // Table update
           $information= User::firstOrNew(['email'=>$email]);
           $information->role=$data['role'];
           $information->name=$data['name'];
           $information->email=$email;
           $information->password=$data['password'];
           $information->org_name=$data['org_name'];
           $information->org_web=$data['org_web'];
           $information->designation=$data['designation'];
           $information->department=$data['department'];
           $information->address=$data['address'];
           $information->country=$data['country'];
           $information->state=$data['state'];
           $information->city=$data['city'];
           $information->pin=$data['pin'];
           $information->save();
        //    echo'<pre>';
        //    print_r($information);die();
        }
    }
    else{
        return redirect()->back()->with('msg','Select any File for upload');
    }
        
    }
        
        
    }
