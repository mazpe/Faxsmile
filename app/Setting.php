<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'entity_id', 'from_email','from_name', 'signature', 'incoming_fax', 'outgoing_fax', 'fax_status_change',
        'unauthorized_access', 'note'
    ];

}
