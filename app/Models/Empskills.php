<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empskills extends Model
{
    use HasFactory;
    protected $table='emp_skills';
    protected $fillable=['emp_id','skill','skill_type','lang','lang_type'];
}
