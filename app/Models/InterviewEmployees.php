<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewEmployees extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='interview_employees';
    public $guarded = ['id'];
}
