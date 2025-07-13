<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas específicas para cada inquilino.
| Estas rutas se cargan automáticamente por el TenantRouteServiceProvider.
*/

// Route::middleware([
//     'web',
//     InitializeTenancyByPath::class,
//     // PreventAccessFromCentralDomains::class,
// ])
// ->prefix('{tenant}')
// ->group(function () {
//     Route::get('/', function () {
//         return 'Tenant actual: ' . tenant('id');
//     });
    
//     Route::get('/dashboard', function () {
//         return 'Dashboard del tenant: ' . tenant('id');
//     });
// });
