<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetDefaultTenantForUrls
{
    public function handle(Request $request, Closure $next)
    {
        URL::defaults(['tenant' => tenant('id')]);

        return $next($request);
    }
}
