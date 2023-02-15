{{-- blade-formatter-disable --}}
@component('mail::message')
<h1> Olá, {{ $order->seller->name }}</h1>
<h4>Um novo pedido foi gerado no sistema:</h4>
<p><strong>Cliente:</strong> {{ $order->client }}</p>
@if ($order->description)
<p><strong>Descrição:</strong> {{ $order->client }}</p>
@endif
<p><strong>Status:</strong> {{ $order->status }}</p>
@component('mail::table')
| Produto | Quantidade | Valor Unitário | Total |
| ------ |:------:| :----:| :-----:|
@foreach ($order->products as $product)
| {{ $product->pivot->title }} | {{ $product->pivot->quantity }} |{{ 'R$ ' . number_format($product->pivot->price / 100, 2, ',', '.') }} |{{ 'R$ ' . number_format(($product->pivot->quantity * $product->pivot->price) / 100, 2, ',', '.') }} |
@endforeach
@endcomponent
@if ($order->discount > 0)
<p><strong>Desconto:</strong> {{ $order->discount }}</p>
@endif
@if ($order->addition > 0)
<p><strong>Acréscimo:</strong> {{ $order->addition }}</p>
@endif
<p><strong>Valor total:</strong> {{ $order->getTotalPrice() }}</p>


@component('mail::button', ['url' => url('/orders')])
Acesse o sistema para editar o pedido
@endcomponent

Obrigado,
<br>
{{ config('app.name') }}
@endcomponent
