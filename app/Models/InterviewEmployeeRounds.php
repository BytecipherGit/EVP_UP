<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeInterview;
use App\Models\EmployeeInterviewStatus;


class InterviewEmployeeRounds extends Model
{
    use HasFactory;
    protected $table='interview_employee_rounds';
    public $guarded = ['id'];

    public function employeeInterview()
    {
        return $this->belongsTo(EmployeeInterview::class,'interview_employees_id','id');
    }

    public function employeeInterviewStatus()
    {
        return $this->belongsTo(EmployeeInterviewStatus::class,'employee_interview_status', 'id');
    }

    public function employeeInterviewProcess()
    {
        return $this->belongsTo(InterviewProcess::class,'interview_processes_id', 'id');
    }
}
