<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    use HasFactory;
    protected $table='email_configurations';
    protected $fillable = [
        "company_id",
        "driver",
        "host",
        "port",
        "from_address",
        "from_name", 
        "encryption",
        "user_name" ,
        "password"
    ];
    // public $guarded = ['id'];
    
}
