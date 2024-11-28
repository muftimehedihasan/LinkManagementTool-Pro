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
        Schema::create('link_tag', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('link_id')->constrained()->onDelete('cascade'); // Link ID
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');  // Tag ID
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_tag');
    }
};
