<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empskills extends Model
{
    use HasFactory;
    protected $table='employee_skills';
    protected $fillable=['employee_id','skill','skill_type'];
}
