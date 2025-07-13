@extends('tenants.layout')

@section('title', 'Editar Inquilino')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar Inquilino: {{ $tenant->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $tenant->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $tenant->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Dominio</label>
                    <input type="text" class="form-control" 
                           value="{{ $tenant->domains->first()->domain ?? 'No configurado' }}" disabled>
                    <small class="form-text text-muted">El dominio no puede ser modificado después de la creación.</small>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('tenants.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Inquilino</button>
                </div>
            </form>
        </div>
    </div>
@endsection
