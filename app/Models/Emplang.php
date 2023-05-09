<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplang extends Model
{
    use HasFactory;
    protected $table='employee_language';
    public $guarded = ['id'];
    
}
