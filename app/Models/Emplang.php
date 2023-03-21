<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplang extends Model
{
    use HasFactory;
    protected $table='emp_language';
    protected $fillable=['emp_id','lang','lang_type'];
}
