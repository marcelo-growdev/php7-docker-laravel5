<h2>Olá, {{ $order->seller }}</h2>

<h3>Um novo pedido foi gerado no sistema:</h3>
<p><strong>Cliente:</strong> {{ $order->client }}</p>
@if ($order->description)
    <p><strong>Descrição:</strong> {{ $order->client }}</p>
@endif
<p><strong>Status:</strong> {{ $order->status }}</p>
<table class="table">
    <thead>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Total</th>
    </thead>
    <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->pivot->title }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ 'R$ ' . number_format($product->pivot->price / 100, 2, ',', '.') }}</td>
                <td>{{ 'R$ ' . number_format(($product->pivot->quantity * $product->pivot->price) / 100, 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if ($order->discount > 0)
    <p><strong>Desconto:</strong> {{ $order->discount }}</p>
@endif
@if ($order->addition > 0)
    <p><strong>Acréscimo:</strong> {{ $order->addition }}</p>
@endif
<p><strong>Valor total:</strong> {{ $order->getTotalPrice() }}</p>

<a href="{{ route('orders.index') }}" target="_blank" class="btn btn-primary btn-block">Acesse o sistema para editar o
    pedido</a>
