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
        Schema::create('resident_names', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 191);
            $table->string('name', 191);
            $table->text('address');
            $table->string('phone_number', 20);
            $table->string('village', 191);
            $table->string('district', 191);
            $table->string('who_brought_it', 191);
            $table->text('information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_names');
    }
};
