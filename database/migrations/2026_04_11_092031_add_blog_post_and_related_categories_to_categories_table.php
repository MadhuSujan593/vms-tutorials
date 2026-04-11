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
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_blog')->default(false)->after('icon');
        });

        Schema::create('related_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('related_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['category_id', 'related_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_categories');
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_blog');
        });
    }
};
