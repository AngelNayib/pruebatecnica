@extends('layouts.layout')

@section('content')
    <div class="container card">
        <div class="card-title">
            <h4>Crear Nuevo Producto</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('producto.store') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre del producto">
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <textarea class="form-control" placeholder="descripcion" id="descripcion" name="descripcion"></textarea>
                            @error('descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio"
                                placeholder="Nombre del producto" min="1" max="1000000" step="1" />
                            @error('precio')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                placeholder="cantidad del producto" min="1" max="1000000" step="1" />
                            @error('cantidad')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select class="form-select" aria-label="Default select example" id="category_id"
                                name="category_id">
                                <option selected disabled>Open this select menu</option>
                                @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
