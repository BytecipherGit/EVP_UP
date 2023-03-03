<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;
    protected $table='company_profile';
    protected $fillable=['com_name','brand_name','website','domain_name','industry','phone','logo','description'];

}
