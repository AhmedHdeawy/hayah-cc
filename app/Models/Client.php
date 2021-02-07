<?php

namespace App\Models;

use Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Client extends Model
{

    protected $guarded = ['status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Set the client's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }


    public function advertisments()
    {
        return $this->hasMany('App\Models\Advertisment', 'client_id');
    }

}
