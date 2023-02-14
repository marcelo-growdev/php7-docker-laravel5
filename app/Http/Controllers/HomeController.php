<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $catCount = Category::count();
        $prodCount = Product::count();
        $orderCount = Order::where('status', 'Venda')->count();
        return view('home', ['category_count' => $catCount, 'product_count' => $prodCount, 'order_count' => $orderCount]);
    }
}