<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faxjob extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'jobid', 'fax_id', 'fax_number', 'action', 'status', 'timestamp'
    ];

}
