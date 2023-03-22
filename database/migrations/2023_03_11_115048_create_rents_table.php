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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('customer_code');
            $table->unsignedBigInteger('user_id');
            $table->date('date_rent');
            $table->date('date_promise');
            $table->integer('jumlah_buku_pinjam');
            $table->timestamps();

            $table->foreign('customer_code')->references('code')->on('customers');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
