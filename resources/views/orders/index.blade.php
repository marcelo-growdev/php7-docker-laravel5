@extends('layouts.default')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Vendas</span>
                    <a href="{{ route('orders.create') }}" role="button">Criar
                        nova venda</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Cliente</th>
                        <th>Descrição</th>
                        <th>Vendedor</th>
                        <th>Status</th>
                        <th class="fit text-center">Ação</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->client }}</td>
                                <td>{{ $order->description }}</td>
                                <td>{{ $order->createdBy->name }}</td>
                                <td>{{ $order->status }}</td>
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
