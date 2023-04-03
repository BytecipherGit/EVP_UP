<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewProcess extends Model
{
    use HasFactory;
    protected $table='interview_processes';
    public $guarded = ['id'];
    
    public function interviewEmployeeProcess()
    {
        return $this->hasOne(InterviewEmployeeRounds::class, 'interview_processes_id', 'id');
    }
}
