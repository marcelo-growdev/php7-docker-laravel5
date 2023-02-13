@extends('layouts.default')

@section('content')
    <div class="col">

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
                        <th class="fit text-center">Ação</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="d-flex"><a href="{{ route('categories.edit', $category) }}">Editar</a>
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('categories.destroy', $category) }}" method="post"
                                        id="deleteForm{{ $category->id }}">
                                        @csrf
                                        @method('delete')
                                        <a onClick="handleDeleteClick({{ $category->id }})" href="#">Deletar</a>
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
