<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class CenterBranch extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'center_branches';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['name', 'address'];

    /**
     * fillable attributes
     */
    protected $fillable = ['discount_value', 'hours', 'latitude', 'longitude', 'notes', 'phone', 'logo', 'center_id',
            'category_id', 'city_id', 'status', 'governorate_id'];

    /**
     * Info that belongs To
     */
    public function center()
    {
        return $this->belongsTo('App\Models\Center', 'center_id', 'id');
    }

    /**
     * Info that belongs To
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    /**
     * Info that belongs To
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Info that belongs To
     */
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate', 'governorate_id', 'id');
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
