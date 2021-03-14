<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url', 'distance'];

    /**
     * Get logo url for the category logo.
     */
    public function getDistanceAttribute()
    {
        if (request()->has('latitude') && request()->has('longitude')) {
            $distance = $this->haversineGreatCircleDistance(
                request()->get('latitude'),
                request()->get('longitude'),
                $this->latitude,
                $this->longitude
            );

            return ceil($distance);
        }
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

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
