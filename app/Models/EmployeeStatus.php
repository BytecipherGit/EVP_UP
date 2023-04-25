<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    use HasFactory;
    protected $table='employee_offer_statuses';
    public $guarded = ['id'];
}
