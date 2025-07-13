@extends('tenants.layout')

@section('title', 'Crear Nuevo Inquilino')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Crear Nuevo Inquilino</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('tenants.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="domain" class="form-label">Subdominio</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('domain') is-invalid @enderror" 
                               id="domain" name="domain" value="{{ old('domain') }}" required>
                        <span class="input-group-text">.{{ config('app.domain', 'localhost') }}</span>
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">Solo letras minúsculas, números y guiones</small>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('tenants.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Inquilino</button>
                </div>
            </form>
        </div>
    </div>
@endsection
