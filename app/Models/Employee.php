<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Employee extends Model implements Authenticatable
{

    use AuthenticableTrait;

    protected $table='employee';

    protected $fillable=[
    'first_name',
    'empCode',
    'profile',
    'last_name',
    'middle_name',
    'email',
    'password',
    'phone',
    'dob',
    'pan_card',
    'pan_card_number',
    'pan_card_id',
    'aadhar_card',
    'aadhar_card_number',
    'aadhar_card_id',
    'passport',
    'passport_number',
    'passport_id',
    'blood_group',
    'gender',
    'marital_status',
    'current_address',
    'permanent_address',
    'emg_name',
    'emg_relationship',
    'emg_phone',
    'emg_address'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $guarded = ['id'];
}
