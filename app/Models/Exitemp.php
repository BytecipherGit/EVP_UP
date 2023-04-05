<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exitemp extends Model
{
    use HasFactory;
    protected $table='exit_employee';
    protected $fillable=['employee_id','do_exit','decipline','reason','rating','document'];
}
