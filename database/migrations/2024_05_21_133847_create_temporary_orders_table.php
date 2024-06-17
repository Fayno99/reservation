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
        Schema::create('temporary_orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->integer('companies_id')->nullable();
            $table->integer('masters_id')->nullable();
            $table->string('clients_id')->nullable();
            $table->integer('works_id')->nullable();
            $table->dateTime('start_order')->nullable();
            $table->dateTime('stop_order')->nullable();
            $table->string('users_id')->nullable();
            $table->string('motorcycles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_orders');
    }
};
