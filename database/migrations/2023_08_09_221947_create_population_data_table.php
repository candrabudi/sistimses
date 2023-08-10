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
        Schema::create('population_data', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 191);
            $table->string('name', 191);
            $table->text('address');
            $table->string('phone_number', 20);
            $table->string('district', 191);
            $table->string('sub_district', 191);
            $table->string('person_responsible', 191);
            $table->text('information');
            $table->string('photo_id', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_data');
    }
};
