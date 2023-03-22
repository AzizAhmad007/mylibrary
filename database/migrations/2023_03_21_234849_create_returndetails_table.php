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
        Schema::create('returndetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('returnbook_id');
            $table->string('book_code');
            $table->timestamps();

            $table->foreign('returnbook_id')->references('id')->on('returnbooks');

            $table->foreign('book_code')->references('code')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returndetails');
    }
};
