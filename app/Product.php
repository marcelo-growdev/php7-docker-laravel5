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

    public function getPrice() {
        return $this->price / 100;
    }
    public function setPrice() {
        return round($this->price * 100);
    }
}