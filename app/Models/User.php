<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'gender',
        'email',
        'password',
        'telephone',
        'picture',
        'presentation',
        'customer_profile',
        'short_description',
        'prefered_language',
        'fidelity_consent',
        'fidelity_card',
        'voyage',
        'culinaire',
        'address',
        'city',
        'postal_code',
        'country'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function getUsernameAttribute($username)
    {
        return ucwords($username);
    }

    public function getPictureAttribute($value)
    {
        if($value == "user-blank.png") {
            return asset('images/user-blank.png');
        } elseif($value){
            return asset('images/users/'.$value);
        } else {
            return asset('images/user-blank.png');
        }
    }

}
