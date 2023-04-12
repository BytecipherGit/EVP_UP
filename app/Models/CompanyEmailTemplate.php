<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEmailTemplate extends Model
{
    use HasFactory;
    protected $table='company_email_templates';
    public $guarded = ['id'];
}
