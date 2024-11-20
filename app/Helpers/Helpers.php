<?php

if (!function_exists('userCanSeeDebugbar')) {
    function userCanSeeDebugbar()
    {
        // Ensure the auth service is available and a user is logged in
        if (auth()->check()) {
            // Use the `is_admin` attribute or add additional checks
            return auth()->user()->is_admin;
        }
        return false;
    }
}
