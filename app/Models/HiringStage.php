<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiringStage extends Model
{
    use HasFactory;
    protected $table='hiring_stages';
    public $guarded = ['id'];
}