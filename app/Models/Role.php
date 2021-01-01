<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //MASS-Assignment
    protected $guarded = [];


    //ROLE IS GOING TO BELONG TO MANY DIFF PERMISSIONS BECAUSE WE HAVE A PIVOT-TABLE
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    //ROLE BELONGS TO MANY USERS
    public function user() {
        return $this->belongsToMany(User::class);
    }


}
