<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use App\Http\Controllers\TenantController;

/*
|--------------------------------------------------------------------------
| Central Routes
|--------------------------------------------------------------------------
| Rutas que solo son accesibles desde la ruta principal (sin prefijo de inquilino)
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['web'])->group(function () {
    Route::resource('tenants', TenantController::class)->names('tenants');
});


Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::get('/dashboard', function () {
        return 'Dashboard del tenant: ' . tenant('id');
    });
});
