<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class Entity extends Model
{
    use SingleTableInheritanceTrait;

    protected $table = "entities";
    protected static $singleTableTypeField = 'type';
    protected static $singleTableSubclasses = [
        Company::class,
        Provider::class,
        Client::class
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'type','name','address_1','address_2','city','state','zip','phone','fax','website','fax_domain','domain',
        'time_zone','external_account','contact_first_name','contact_last_name', 'contact_phone','contact_email','note'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}