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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('rack_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher_book');
            $table->date('publisher_year');
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('rack_id')->references('id')->on('racks');

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
