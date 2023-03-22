<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewEmployeeRounds extends Model
{
    use HasFactory;
    protected $table='interview_employee_rounds';
    public $guarded = ['id'];
}
