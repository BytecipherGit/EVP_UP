<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTest extends Model
{
    use HasFactory;
    protected $table='employee_test';
    public $guarded = ['id'];
}
