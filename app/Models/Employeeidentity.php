<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeeidentity extends Model
{
    use HasFactory;
    protected $table='employee_identity';
    protected $fillable=['employee_id','id_type','id_number','document','verification_type'];

   function user(){
    return $this->belongsTo(Employee::class,'employee_id');  
  }

}
