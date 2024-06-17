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
        Schema::table('masters', function (Blueprint $table) {
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('master_schedules', function (Blueprint $table) {
            $table->foreign('masters_id')->references('id')->on('masters')->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('masters_id')->references('id')->on('masters')->onDelete('cascade');
        });

        Schema::table('work_orders', function (Blueprint $table) {
            $table->foreign('masters_id')->references('id')->on('masters')->onDelete('cascade');
            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('works_id')->references('id')->on('works')->onDelete('cascade');
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->dropForeign(['companies_id']);
        });
        Schema::table('master_schedules', function (Blueprint $table) {
            $table->dropForeign(['masters_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['masters_id']);
        });

        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['masters_id']);
            $table->dropForeign(['clients_id']);
            $table->dropForeign(['users_id']);
            $table->dropForeign(['works_id']);
            $table->dropForeign(['companies_id']);
        });

    }






};
