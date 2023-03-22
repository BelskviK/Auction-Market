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
        Schema::create('lots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->decimal('cogs')->default(0)->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
        
        Schema::table('lots', function (Blueprint $table) {
            $table->index('category_id');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
