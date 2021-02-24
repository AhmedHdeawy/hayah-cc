<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * fillable attributes
     */
    protected $fillable = ['card_id', 'start_date', 'end_date', 'is_used', 'notes'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['expired'];

    public function getExpiredAttribute()
    {
        if (now() > Carbon::createFromFormat('d-m-Y', $this->end_date)) {
            return false;
        }
        return true;
    }
}
