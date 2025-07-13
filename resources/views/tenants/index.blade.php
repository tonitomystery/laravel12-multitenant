@extends('tenants.layout')

@section('title', 'Lista de Inquilinos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Inquilinos</h1>
        <a href="{{ route('tenants.create') }}" class="btn btn-primary">Nuevo Inquilino</a>
    </div>

    @if($tenants->isEmpty())
        <div class="alert alert-info">No hay inquilinos registrados.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Dominio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td>{{ $tenant->id }}</td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>
                                @if($tenant->domains->isNotEmpty())
                                    {{ $tenant->domains->first()->domain }}
                                @else
                                    <span class="text-muted">Sin dominio</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tenants.show', $tenant) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar este inquilino?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{ $tenants->links() }}
    @endif
@endsection
