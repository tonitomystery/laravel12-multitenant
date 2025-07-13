<?php

namespace App\Http\Middleware;

use App\Resolvers\PathTenantResolver;
use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Middleware\IdentificationMiddleware;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyByPath extends IdentificationMiddleware
{
    /** @var PathTenantResolver */
    protected $resolver;

    public function __construct(PathTenantResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $this->initializeTenancy(
            $request,
            $next,
            $this->resolver
        );
    }
}
