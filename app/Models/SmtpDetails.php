<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpDetails extends Model
{
    use HasFactory;
    protected $table='smtp_details';
    public $guarded = ['id'];
    
}