@extends('layouts.default')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Pedidos</span>
                    <a href="{{ route('orders.create') }}" role="button">Criar
                        novo pedido</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Vendedor</th>
                        <th>Valor</th>
                        <th class="fit text-center">Ação</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->client }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->seller->name }}</td>
                                <td>{{ $order->getTotalPrice() }}</td>
                                <td class="d-flex"><a href="{{ route('orders.edit', $order) }}">Editar</a>
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('orders.destroy', $order) }}" method="post"
                                        id="deleteForm{{ $order->id }}">
                                        @csrf
                                        @method('delete')
                                        <a onClick="handleDeleteClick({{ $order->id }})" href="#">Deletar</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function handleDeleteClick(id) {
            const form = document.getElementById(`deleteForm${id}`);
            return confirm('Deseja deletar esse registro?') ? form.submit() : null;
        }
    </script>
@endsection
