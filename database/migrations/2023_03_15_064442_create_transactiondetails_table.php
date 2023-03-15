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
        Schema::create('transactiondetails', function (Blueprint $table) {
            $table->id();
            $table->integer('rent_date_return');
            $table->integer('returnbook_date_return');
            $table->bigInteger('charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactiondetails');
    }
};
