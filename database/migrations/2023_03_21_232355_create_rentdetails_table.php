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
        Schema::create('rentdetails', function (Blueprint $table) {
            $table->id();
            $table->string('rent_code')->unique();
            $table->string('book_code');
            $table->timestamps();

            $table->foreign('rent_code')->references('code')->on('rents');

            $table->foreign('book_code')->references('code')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentdetails');
    }
};
