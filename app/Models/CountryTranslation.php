<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'country_translations';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'countries_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['country_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
}
