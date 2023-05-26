<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubscriptionPayment extends Model
{
    use HasFactory;
    protected $table ='company_subscription_payment' ;
    public $guarded = ['id'];
}
