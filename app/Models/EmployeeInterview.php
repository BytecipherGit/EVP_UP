<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InterviewEmployeeRounds;
use App\Models\EmployeeInterviewStatus;
use App\Models\InterviewProcess;

class EmployeeInterview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='interview_employees';
    public $guarded = ['id'];

    public function interviewEmployeeRounds()
    {
        return $this->hasMany(InterviewEmployeeRounds::class,'interview_employees_id','id');
    }

    public function lastInterviewEmployeeRounds()
    {
        return $this->hasOne(InterviewEmployeeRounds::class, 'interview_employees_id', 'id')->latest()->limit(1);
    }

    public function interviewEmployeeStatus()
    {
        return $this->hasOne(InterviewEmployeeRounds::class, 'employee_interview_status', 'id');
    }

    public function interviewEmployeeProcess()
    {
        return $this->hasOne(InterviewEmployeeRounds::class, 'interview_processes_id', 'id');
    }
}
