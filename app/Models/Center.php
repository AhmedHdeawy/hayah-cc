<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Center extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'centers';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['name', 'address', 'coupon'];

    /**
     * fillable attributes
     */
    protected $fillable = ['discount_value', 'hours', 'latitude', 'longitude', 'notes', 'phone', 'logo',
            'category_id', 'governorate_id', 'city_id', 'status'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url'];

    /**
     * Get logo url for the category logo.
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        } else {
            $http = substr($this->logo, 0, 4);
            if ($http == 'http') {
                return $this->logo;
            }
            return Storage::disk('public')->url($this->logo);
        }
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
     * Info that belongs To
     */
    public function branches()
    {
        return $this->hasMany('App\Models\CenterBranch', 'center_id', 'id');
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
