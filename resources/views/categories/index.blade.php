@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Categorias</span>
                            <a href="{{ route('categories.create') }}" role="button">Criar
                                nova categoria</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>Ação</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="d-flex flex-collunm"><a
                                                href="{{ route('categories.edit', $category) }}">Editar</a> <span
                                                class="mx-2">|</span>
                                            <form action="{{ route('categories.destroy', $category) }}" method="post"
                                                id="deleteForm{{ $category->id }}">
                                                @csrf
                                                @method('delete')
                                                <a onClick="handleDeleteClick({{ $category->id }})"
                                                    href="#">Deletar</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
