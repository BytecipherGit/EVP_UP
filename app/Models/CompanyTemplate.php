<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTemplate extends Model
{
    use HasFactory;
    protected $table='company_templates';
    protected $fillable=['email_type','content'];
}
