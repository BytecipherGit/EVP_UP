<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exitemp extends Model
{
    use HasFactory;
    protected $table='exit_employee';
    public $guarded = ['id'];
}
