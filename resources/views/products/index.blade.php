@extends('layouts.default')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Produtos</span>
                    <a href="{{ route('products.create') }}" role="button">Criar
                        novo produto</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Ação</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>R$ {{ $product->price }}</td>
                                <td><a href="{{ route('products.edit', $product) }}">Editar</a> | <form
                                        action="{{ route('products.destroy', $product) }}" method="post"
                                        id="deleteForm{{ $product->id }}">
                                        @csrf
                                        @method('delete')
                                        <a onClick="handleDeleteClick({{ $product->id }})" href="#">Deletar</a>
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
