<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewTemplate extends Model
{
    use HasFactory;
    protected $table='interview_templates';
    protected $fillable=['company_id','email_type','content'];
}
