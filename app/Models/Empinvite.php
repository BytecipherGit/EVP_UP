<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empinvite extends Model
{
    use HasFactory;
    protected $table='invite_employees';
    protected $fillable=['first_name','middle_name','last_name','email','phone'];
}
