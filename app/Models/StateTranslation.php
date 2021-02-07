<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'state_translations';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'states_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['state_id', 'locale', 'name'];


    /**
     * State that belongs To
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }
}
