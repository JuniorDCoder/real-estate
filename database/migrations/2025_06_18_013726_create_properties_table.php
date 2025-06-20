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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('property_type')->default('House'); // e.g., House, Apartment, Commercial
            $table->string('building_type')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Property status
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_new')->default(true);
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->float('area')->nullable(); // in square feet or meters
            $table->string('image')->nullable(); // store image filename or path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
