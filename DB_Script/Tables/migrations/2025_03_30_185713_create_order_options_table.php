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
        Schema::create('order_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->foreignId('option_id')->constrained('options')->onDelete('cascade');
            $table->decimal('price', 10, 2)->default(0.00); // Extra cost per option
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_options');
    }
};
