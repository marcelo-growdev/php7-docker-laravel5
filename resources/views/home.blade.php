@extends('layouts.default')

@section('content')
  <div class="col">
    <div class="row">

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">São</h5>
            <p class="display-3 text-center">{{ $category_count }}</p>
            <p class="text-right">categorias</p>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-block">Ir para
              categorias</a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Com mais de</h5>
            <p class="display-3 text-center">{{ $product_count }}</p>
            <p class="text-right">produtos cadastrados.</p>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block">Ir para
              produtos</a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gerando um total de</h5>
            <p class="display-3 text-center">{{ $order_count }}</p>
            <p class="text-right">vendas.</p>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-block">Ir para
              pedidos</a>
          </div>
        </div>
      </div>
    </div>
  @endsection
