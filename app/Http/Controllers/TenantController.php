<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::latest()->paginate(10);
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'domain' => 'required|string|unique:domains,domain',
        ]);

        // Crear el inquilino
        $tenant = Tenant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'data' => [],
        ]);

        // Crear el dominio para el inquilino
        $tenant->domains()->create([
            'domain' => $validated['domain'] . '.' . config('app.domain', 'localhost'),
        ]);

        return redirect()->route('tenants.index')
            ->with('success', 'Inquilino creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('tenants')->ignore($tenant->id),
            ],
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.index')
            ->with('success', 'Inquilino actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        // Eliminar el inquilino
        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('success', 'Inquilino eliminado exitosamente.');
    }
}
