<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getPrice() {
        return 'R$ ' . number_format($this->price / 100, 2, ',', '.');
    }
    public function setPrice($price) {
        $this->price = round($price * 100);
    }
}