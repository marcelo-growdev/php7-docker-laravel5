<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client', 'description', 'status'
    ];

    public function products() {
        return $this->belongsToMany('App\Products')->withPivot('title', 'description', 'quantity', 'price');
    }
}