<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name'
    ];

    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
