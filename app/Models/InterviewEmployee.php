<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewEmployee extends Model
{
    use HasFactory;
    protected $table='interview_employees';
    public $guarded = ['id'];
}
