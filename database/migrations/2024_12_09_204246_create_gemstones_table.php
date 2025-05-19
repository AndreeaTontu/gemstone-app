<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. The up() method will define the schema to create the gemstones table in our database.
     * When the migration is run it is executed.
     */
    public function up(): void 
    {
        Schema::create('gemstones', function (Blueprint $table) {
            $table->id(); // Here an auto incrementing id column is created as the primary key.
            $table->string('name');
            $table->string('location');
            $table->string('colour');
            $table->string('association');
            $table->string('meaning');
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null'); // Foreign key constrain
            $table->timestamps(); // This is to track creation and updates of the record. It adss created-at and updated_at columns.
        });
    }

    /**
     * Reverse the migrations. The down() method will reverse the migrations changes caried in the up method 
     */
    public function down(): void 
    {   
        //This is to drop the gemstones table if it already exist.
        Schema::dropIfExists('gemstones'); 
    }
};
