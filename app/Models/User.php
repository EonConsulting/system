<?php

namespace App\Models;

use EONConsulting\LaravelLTI\Models\UserLTILink;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lti() {
        return $this->hasMany(UserLTILink::class, 'user_id', 'id');
    }

    public function hasLtiLink($user_id) {
        return (bool) $this->lti->where('lti_user_id', $user_id)->count();
    }

}
