<?php

namespace App\Resolvers;

use Illuminate\Http\Request;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Tenancy;
use Exception;

class PathTenantResolver
{
    /** @var string|null */
    public static $tenantParameterName = 'tenant';

    /** @var Tenancy */
    protected $tenancy;

    public function __construct(Tenancy $tenancy)
    {
        $this->tenancy = $tenancy;
    }

    public function resolve(Request $request): Tenant
    {
        $tenant = $request->route(static::$tenantParameterName);

        if (! $tenant) {
            throw new Exception('Tenant could not be identified by path: ' . $request->getPathInfo());
        }

        $tenantModel = $this->tenancy->model()->find($tenant);
        
        if (! $tenantModel) {
            throw new Exception('Tenant could not be identified by path: ' . $request->getPathInfo());
        }
        
        return $tenantModel;
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [static::$tenantParameterName => $tenant->getTenantKey()];
    }

    public function getTenantFromRequest(Request $request): ?string
    {
        $tenant = $request->route(static::$tenantParameterName);
        return $tenant ? (string) $tenant : null;
    }
}
