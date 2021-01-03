<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // MUTATOR PASSWORD - everytime we update a password with Models, we encrypt it
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
    //ACCESSOR 4 image
    public function getAvatarAttribute($value) {
        return asset($value);
    }


    // create relationship: that the user has many different posts
    public function posts() {
        return $this->hasMany(Post::class);
    }


    //RELATIONSHIPS - ROLES & PERMISSIONS
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }


    // 1st step to let admin only see dashboard
    public function userHasRole($role_name) {

        foreach($this->roles as $role) {
            
            if(Str::lower($role_name) == Str::lower($role->name)) {
                return true;
            }
        }

        return false;
    }


}
