<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterTranslation extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'center_trans_id';

    /**
     * table
     */
    protected $table = 'center_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['center_id', 'locale', 'name', 'address'];


    /**
     * Info that belongs To
     */
    public function center()
    {
        return $this->belongsTo('App\Models\Center', 'center_id', 'id');
    }
}
