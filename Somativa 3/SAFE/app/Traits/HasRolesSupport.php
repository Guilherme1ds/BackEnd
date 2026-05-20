<?php

namespace App\Traits;

/**
 * Trait that declares the HasRoles methods for IDE support
 * This is used alongside Spatie\Permission\Traits\HasRoles
 * 
 * @mixin \Spatie\Permission\Traits\HasRoles
 */
trait HasRolesSupport
{
    /**
     * Determine if the model has a given role.
     */
    public function hasRole(string|array|\Illuminate\Database\Eloquent\Collection $roles, ?string $guard = null): bool
    {
        // This method is provided by Spatie\Permission\Traits\HasRoles
        // This trait just provides type hints for static analysis tools
        return parent::hasRole($roles, $guard);
    }
}
