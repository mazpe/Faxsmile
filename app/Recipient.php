<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $table = 'users';
    public $fillable = [
        'entity_id', 'fax_id', 'first_name', 'last_name', 'password', 'email', 'note'
    ];

    /**
     * Get the faxes for the recipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function faxes() {
        return $this->belongsToMany('App\Fax','fax_recipients');
    }
}
