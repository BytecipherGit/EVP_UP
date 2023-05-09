<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empworkhistory extends Model
{
    use HasFactory;
    protected $table='employee_workhistories';
    // protected $fillable=['employee_id','com_name','designation','offer_letter','work_duration_from','work_duration_to','exp_letter','salary_slip','verification_type'];
    public $guarded = ['id'];
}
