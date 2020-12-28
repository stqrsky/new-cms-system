<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    // mass assignment with guarded - don't have to name all columns
    protected $guarded = [];

    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'post_image',
    //     'body'
    // ];

    // create a relationship: each post is going to have a user
    public function user() {
        return $this->belongsTo(User::class);
    }

}
