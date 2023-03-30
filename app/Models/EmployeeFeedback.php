<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFeedback extends Model
{
    use HasFactory;
    protected $table='interview_employee_feedback';
    public $guarded = ['id'];
}
