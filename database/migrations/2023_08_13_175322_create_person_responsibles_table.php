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
        Schema::create('person_responsibles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('phone_number', 20);
            $table->string('district', 191);
            $table->string('sub_district', 191);
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_responsibles');
    }
};
