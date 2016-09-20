<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fax extends Model
{
    /**
     * Get the client that owns the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }
}
