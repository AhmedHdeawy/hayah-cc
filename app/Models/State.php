<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class State extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * translated attributes
     */
    public $translatedAttributes = ['name'];

    /**
     * fillable attributes
     */
    protected $fillable = ['country_id', 'status'];


    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    /**
     * Scope a query to get active data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1')->orderBy('id');
    }

}
