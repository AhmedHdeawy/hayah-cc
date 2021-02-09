<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterBranchTranslation extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'center_branches_trans_id';

    /**
     * table
     */
    protected $table = 'center_branches_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['center_branch_id', 'locale', 'name', 'address', 'coupon'];


    /**
     * Info that belongs To
     */
    public function centerBranch()
    {
        return $this->belongsTo('App\Models\CenterBranch', 'center_branch_id', 'id');
    }
}
