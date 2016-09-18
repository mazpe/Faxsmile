<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $fillable = [
        'type','name','address_1','address_2','city','state','zip','phone','fax','website','fax_domain','domain',
        'time_zone','external_account','contact','contact_phone','notes'
    ];
}
