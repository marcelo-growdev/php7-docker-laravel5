<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client', 'description', 'status'
    ];

    private $totalPrice;

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('title', 'quantity', 'price');
    }

    public function seller() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function getDiscount() {
        return $this->price / 100;
    }
    public function setDiscount($value) {
        $this->discount = round($value * 100);
    }
    public function getAddition() {
        return $this->price / 100;
    }
    public function setAddition($value) {
        $this->addition = round($value * 100);
    }

    public function getTotalPrice() {
        $this->totalPrice = $this->addition - $this->discount;
        $this->products->each(function ($product) {
            $this->totalPrice += $product->pivot->quantity * $product->pivot->price;
        });
        return 'R$ ' . number_format($this->totalPrice / 100, 2, ',', '.');
    }
}
