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
        Schema::create('address_data', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 10);
            $table->char('state', 2);
            $table->string('city', 50);
            $table->string('neighborhood', 40)->nullable();
            $table->string('street', 75)->nullable();
            $table->string('service', 25);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_data');
    }
};
