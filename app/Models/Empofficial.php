<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empofficial extends Model
{
    use HasFactory;
    protected $table='employee_officials';
    protected $fillable=['employee_id','doj','prob_period','emp_type','work_location','emp_status','salary','lpa','app_from','app_to','last_app_desig','current_app_desig','app_date','pro_from','pro_to','last_pro_desig','current_pro_desig','pro_date','mang_name','mang_type','mang_dept','mang_desig'];
}
