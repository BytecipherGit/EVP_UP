<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingProcess extends Model
{
    use HasFactory;
    protected $table='onboarding_processes';
    public $guarded = ['id'];
}
