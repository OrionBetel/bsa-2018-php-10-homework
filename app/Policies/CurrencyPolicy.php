<?php

namespace App\Policies;

use App\User;
use App\Entity\Currency;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function view(User $user, Currency $currency)
    {
        //
    }

    /**
     * Determine whether the user can create currencies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function update(User $user, Currency $currency)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function delete(User $user, Currency $currency)
    {
        return $user->is_admin;
    }
}
