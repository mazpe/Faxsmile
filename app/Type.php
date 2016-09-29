<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    /**
     * Get the Entities that belogns to the Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities() {
        return $this->hasMany('App\Entity');
    }
}
