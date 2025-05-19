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
        Schema::create('gemstone_grade', function (Blueprint $table) {
            $table->id();
            $table->foreignID('gemstone_id')->references('id')->on('gemstones') //creating gemstone_id column and defining the foreign key
                  ->onDelete('cascade');
            $table->foreignID('grade_id')->references('id')->on('grades') //creating grade_id column and defining the foreign key
                  ->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gemstone_grade');
    }
};
