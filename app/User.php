<?php

namespace App;

use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    public const FOLLOWER = '1';
    public const SUBSCRIBER = '2';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name_for_avatar'];

    protected $guarded = ['status', 'role'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'gender', 'avatar', 'youtube_channel', 'instagram_channel', 'channel_url', 'provider_name', 'provider_id', 'country_id', 'state_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider_name', 'provider_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }


    public function favorites()
    {
        return $this->belongsToMany('App\Models\Video', 'favorites', 'user_id', 'video_id');
    }

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

    /**
     * Set Client logo
     *  @param string $file
     */
    public function setAvatarAttribute($file)
    {
    	if ($file) {

	        if (is_string($file)) {
	          $this->attributes['avatar'] = $file;

	        } else {

	          $name =  $file->getClientOriginalName();
	          $name = time() . '_' . $name;

	          Image::make($file)->save('uploads/users/'. $name);

	          $this->attributes['avatar'] = $name;
	        }
    	}
    }

    /**
     * Get the the name for avatar.
     */
    public function getNameForAvatarAttribute()
    {
        return $this->nameForAvatar();
    }

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function nameForAvatar()
    {
        $name = explode(' ', $this->name);  // Example:  'ahmed mohamed ali taha'
        $shortForvatar = implode(' ', [$name[0], $name[1] ?? null]);    // 'ahmed mohamed'
        return $shortForvatar;
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'user_id');
    }

}
