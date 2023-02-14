<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('orders.index', ['orders' => $orders]);
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', ['products' => $products]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => 'required|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required',
            'discount' => 'numeric|min:0',
            'addition' => 'numeric|min:0',
            'product_id' => 'required|min:1',
            'product_title' => 'required|min:1',
            'product_price' => 'required|min:1',
            'product_quantity' => 'required|min:1',
        ]);
        $order = new Order([
            'client' => $validated['client'],
            'description' => $validated['description'],
            'status' => $validated['status']
        ]);
        $order->setDiscount($validated['discount']);
        $order->setAddition($validated['addition']);
        $order->seller()->associate(auth()->user());
        $order->save();
        for($i=0; $i < count($validated['product_id']); $i++) {
            $order->products()->attach($validated['product_id'][$i], [
                'title' => $validated['product_title'][$i],
                'quantity' => $validated['product_quantity'][$i],
                'price' => $validated['product_price'][$i] * 100,
            ]);
        }
        $order->save();

        event(new NewOrderEvent($order));
        return redirect()->route('orders.index');
    }

    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', ['order' => $order, 'products' => $products]);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'client' => 'required|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required',
            'discount' => 'numeric|min:0',
            'addition' => 'numeric|min:0',
            'product_id' => 'required|min:1',
            'product_title' => 'required|min:1',
            'product_price' => 'required|min:1',
            'product_quantity' => 'required|min:1',
        ]);
        $order->client = $validated['client'];
        $order->description = $validated['description'];
        $order->status = $validated['status'];
        $order->setDiscount($validated['discount']);
        $order->setAddition($validated['addition']);
        $order->products()->detach();
        for($i=0; $i < count($validated['product_id']); $i++) {
            $order->products()->attach($validated['product_id'][$i], [
                'title' => $validated['product_title'][$i],
                'quantity' => $validated['product_quantity'][$i],
                'price' => $validated['product_price'][$i] * 100,
            ]);
        }
        $order->save();
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }
}