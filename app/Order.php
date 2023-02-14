<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client', 'description', 'status'
    ];

    private $totalPrice, $subTotal;

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('id', 'title', 'quantity', 'price');
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

    public function getTotalPrice($formatted = true) {
        $this->totalPrice = $this->addition - $this->discount;
        $this->totalPrice += $this->getSubTotal(false, false);
        if($formatted) {
            return 'R$ ' . number_format($this->totalPrice / 100, 2, ',', '.');
        }
        return $this->totalPrice / 100;
    }

    public function getSubTotal($formatted = true, $view = true) {
        $this->subTotal = 0;
        $this->products->each(function ($product) {
            $this->subTotal += $product->pivot->quantity * $product->pivot->price;
        });
        if($formatted) {
            return 'R$ ' . number_format($this->subTotal / 100, 2, ',', '.');
        }
        return $view ? $this->subTotal / 100 : $this->subTotal;
    }
}
