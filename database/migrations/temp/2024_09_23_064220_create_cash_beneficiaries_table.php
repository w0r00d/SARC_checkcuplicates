<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cash_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            $table->string('fullname');
            $table->enum('governate', ['Damascus', 'Aleppo', 'Homs', 'Hama', 'Latakia', 'Tartous', 'As-Sweida', 'Ar-Raqqa', 'Daraa', 'Idleb', 'Quneitra', 'Rurla Damascus', 'Der-ezzor']);
            $table->integer('value');
            $table->date('transfer_date');
            $table->string('project');
            $table->string('donor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_beneficiaries');
    }
};
