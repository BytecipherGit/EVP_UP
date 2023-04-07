<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empqualification extends Model
{
    use HasFactory;
    protected $table='employee_qualifications';
    protected $fillable=['inst_name','degree','subject','duration_from','duration_to','document','verification_type'];
}
