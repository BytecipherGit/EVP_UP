<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empofficial extends Model
{
    use HasFactory;
    protected $table='employee_officials';
    public $guarded = ['id'];
    // protected $fillable=['employee_id','date_of_joining','emp_type','work_location','emp_status','lpa','designation'];
}
