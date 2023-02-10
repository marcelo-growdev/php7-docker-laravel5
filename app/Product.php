<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'price',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }
}