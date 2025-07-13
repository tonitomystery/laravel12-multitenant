@extends('tenants.layout')

@section('title', 'Detalles del Inquilino: ' . $tenant->name)

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Detalles del Inquilino</h2>
            <div>
                <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Información Básica</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $tenant->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $tenant->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $tenant->email }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Creación</th>
                            <td>{{ $tenant->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización</th>
                            <td>{{ $tenant->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Dominios</h4>
                    @if($tenant->domains->isNotEmpty())
                        <ul class="list-group">
                            @foreach($tenant->domains as $domain)
                                <li class="list-group-item">
                                    <a href="http://{{ $domain->domain }}" target="_blank">
                                        {{ $domain->domain }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">Este inquilino no tiene dominios configurados.</div>
                    @endif
                </div>
            </div>
            
            <div class="mt-4">
                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('¿Estás seguro de eliminar este inquilino? Esta acción no se puede deshacer.')">
                        Eliminar Inquilino
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
