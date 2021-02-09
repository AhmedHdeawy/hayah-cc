<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Governorate extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'governorates';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['name'];

    /**
     * fillable attributes
     */
    protected $fillable = ['status', 'image'];

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
