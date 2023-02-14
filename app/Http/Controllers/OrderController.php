<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        // return $validated;
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
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Order $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $category)
    {
        return view('orders.edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $category)
    {
        //
    }
}