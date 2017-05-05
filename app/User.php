<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GrahamCampbell\Markdown\Facades\Markdown;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts(){
        return $this->hasMany(post::class,'author_id');
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function getBioHtmlAttribute($value){
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : Null;
    }
    public function gravatar(){
        $email = $this->email;
        $default = "https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png";
        $size = 100;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }
    public function setPasswordAttribute($value)
{
    if (!empty($value)) $this->attributes['password'] = crypt($value,'');
}
}
