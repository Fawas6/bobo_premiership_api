<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    /**
     * Get the authenticated user instance.
     *
     * @return \App\Models\User|null
     */
    function user()
    {
        return Auth::user();
    }
}
