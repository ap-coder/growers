<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration documents the shift from team-based to client-based multi-tenancy.
     * We're keeping team_id columns for backward compatibility and data integrity,
     * but the application logic will now use client_id for tenant isolation.
     * 
     * Multi-tenancy logic:
     * - Regular users: Can only see data for their assigned client (via user.client_id)
     * - Admins/Developers: Can see all clients and switch between them
     * - Team is deprecated for tenancy but kept for potential future use
     */
    public function up(): void
    {
        // No schema changes needed - this is a logical refactor
        // The application will now use client_id from auth()->user()->client_id
        // instead of team_id for data isolation
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No schema changes to reverse
    }
};
