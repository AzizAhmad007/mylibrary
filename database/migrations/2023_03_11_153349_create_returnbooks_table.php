<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returnbooks', function (Blueprint $table) {
            $table->id();
            $table->string('rent_code')->unique();
            $table->string('customer_code');
            $table->unsignedBigInteger('user_id');
            $table->date('date_return');
            $table->date('rent_date_promise');
            $table->bigInteger('charge');
            $table->timestamps();

            $table->foreign('rent_code')->references('code')->on('rents');

            $table->foreign('customer_code')->references('code')->on('customers');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returnbooks');
    }
};
