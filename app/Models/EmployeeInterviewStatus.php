<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InterviewEmployeeRounds;
class EmployeeInterviewStatus extends Model
{
    use HasFactory;
    protected $table='employee_interview_statuses';
    public $guarded = ['id'];

    public function interviewEmployeeStatus()
    {
        return $this->hasOne(InterviewEmployeeRounds::class, 'employee_interview_status', 'id');
    }
}
