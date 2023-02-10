@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Cadastrar nova categoria</span>
                            <a class="" href="{{ route('categories.index') }}" role="button">Voltar a listagem</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('categories.update', $category) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" id="name" value="{{ old('name') ?? $category->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end"><button type="reset"
                                    class="btn btn-secondary mr-2">Limpar</button>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
