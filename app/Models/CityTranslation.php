<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'city_trans_id';

    /**
     * table
     */
    protected $table = 'city_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['city_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
}
