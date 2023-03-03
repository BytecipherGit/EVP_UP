<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table='emp_basicinfo';
    protected $fillable=['first_name','profile','last_name','middle_name','email','phone','dob','blood_group','gender','marital_status','current_address','permanent_address','emg_name','emg_relationship','emg_phone','emg_address','status'];
}

