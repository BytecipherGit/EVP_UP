<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeeidentity extends Model
{
    use HasFactory;
    protected $table='emp_identity';
    protected $fillable=['emp_id','id_type','id_number','document','verification_type'];

   function user(){
    return $this->belongsTo(Employee::class,'emp_id');  
  }

}
