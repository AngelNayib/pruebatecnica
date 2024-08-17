@extends('layouts.layout')
@section('content')
    <div class="container card">
        <div class="row card-title">
            <div class="col-12 justify-content-end d-flex">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('producto.create') }}'">Crear
                    Producto</button>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger">{{ session('errors') }}</div>
        @endif
        <div class="row card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <th scope="row">{{ $producto->id }}</th>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>{{ $producto->category->nombre }}</td>
                            <td class="d-flex">
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location='{{ route('producto.edit', $producto->id) }}'">Editar</button>
                                <form action="{{ route('producto.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{ $productos->links() }}
        </div>
    </div>
@endsection
