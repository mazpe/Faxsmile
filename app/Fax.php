<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Recipient;
use App\Sender;

class Fax extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

//    protected $softCascade = ['recipients'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'provider_id', 'client_id','sender_id', 'number', 'description', 'note'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Listen to the Fax deleted an event.
         * - check if fax users are not been used by any other Fax and delete user too
         *
         * @param  $client
         * @return void
         */
//        static::deleting(function(Fax $fax)
//        {
//            $deleteUsers = collect();
//
//            // get all user_ids of the Fax as a sender or reciever
//            $usersWithFaxRelation = $fax->recipients->pluck('id')->merge($fax->senders->pluck('id'));
//
//
//            // delete fax to recipeints and remove fax from sender
//            $fax->recipients()->detach();
//            $fax->senders()->update(['fax_id' => null]);
//
//
//            foreach($usersWithFaxRelation->unique()->toArray() as $user_id) {
//                if ( (isset(Recipient::find($user_id)->faxes) && Recipient::find($user_id)->faxes->count()) < 0 || (isset(Sender::find($user_id)->fax) && Sender::find($user_id)->fax->count() < 0) )
//                {
//                    $deleteUsers = $deleteUsers->merge(collect([$user_id]));
//                }
//            }
//
//            DB::rollBack();
//            dd($deleteUsers);
//
//                die();
//
//
//
//            return $fax;
//        });


    }

    /**
     *  Set user_id to value or null
     *
     * @param $value
     */
    public function setSenderIdAttribute($value) {
        $this->attributes['sender_id'] = ($value ? $value : null);
    }

    /**
     * Get the provider that owns the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider() {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }

    /**
     * Get the client for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the senders for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function senders() {
        return $this->hasMany('App\Sender');
    }

    /**
     * Get the users for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users() {
        return $this->hasMany('App\User');
    }

    /**
     * Get the users for the fax
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function recipients() {
        return $this->belongsToMany('App\Recipient','fax_recipients')->withTimestamps();
    }
}
