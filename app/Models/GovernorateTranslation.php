<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernorateTranslation extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'governorate_trans_id';

    /**
     * table
     */
    protected $table = 'governorate_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['governorate_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate', 'governorate_id', 'id');
    }
}
