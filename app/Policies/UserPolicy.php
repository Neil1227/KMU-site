<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    protected function isSuperAdmin(User $user): bool
    {
        return $user->hasRole('KMU'); // KMU = full access
    }

protected function canUpdatePage(User $user, string $page): bool
{
    if ($this->isSuperAdmin($user)) return true;

    return match($page) {
        // TBI pages
        'notifications', 'registered' => $user->hasRole('TBI'),

        // IPTBM pages
        'commodities' => $user->hasRole('IPTBM'),

        default => false,
    };
}


    // Example methods used in Blade
    public function update(User $user, string $page): bool
    {
        return $this->canUpdatePage($user, $page);
    }
}
