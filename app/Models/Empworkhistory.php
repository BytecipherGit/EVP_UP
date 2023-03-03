<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empworkhistory extends Model
{
    use HasFactory;
    protected $table='emp_workhistories';
    protected $fillable=['emp_id','com_name','designation','offer_letter','work_duration_from','work_duration_to','exp_letter','salary_slip','verification_type'];
}
