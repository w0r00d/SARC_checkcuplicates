<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
        CREATE VIEW beneficiaries_view AS
        SELECT cb.*
        FROM cash_beneficiaries cb
        UNION ALL
        select pb.*
        FROM pending_beneficiaries pb
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries_view');
    }
};
