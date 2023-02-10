@extends('layouts.default')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Cadastrar novo produto</span>
                    <a class="" href="{{ route('products.index') }}" role="button">Voltar a listagem</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            name="title" id="title" value="{{ old('title') ?? $product->title }}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            name="description" id="description" value="{{ old('description') ?? $product->description }}">
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                            name="price" id="price" value="{{ old('price') ?? $product->price }}">
                        @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
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
@endsection
