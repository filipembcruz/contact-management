<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'contact', 'email'
    ];  

    /**
     * Hidden timestamps
     */
    protected $hidden = ["created_at", "updated_at", "deleted_at"];

}
