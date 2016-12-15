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
        'job_id', 'fax_id', 'fax_from', 'fax_to', 'action', 'status', 'status_description', 'sendtime', 'completetime',
        'xmittime', 'pagecount', 'xmitpages'
    ];

    /**
     * Get the fax for the fax job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fax() {
        return $this->belongsTo('App\Fax');
    }
}
