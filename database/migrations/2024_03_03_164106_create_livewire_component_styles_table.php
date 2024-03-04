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
        Schema::create('livewire_component_styles', function (Blueprint $table) {
            $table->foreignId('livewire_component_id')->constrained()->cascadeOnDelete();
            $table->foreignId('style_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livewire_component_styles');
    }
};
