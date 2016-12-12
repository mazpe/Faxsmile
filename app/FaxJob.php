<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaxJob extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'job_id', 'fax_id', 'fax_number', 'action', 'status', 'timestamp'
    ];

}
