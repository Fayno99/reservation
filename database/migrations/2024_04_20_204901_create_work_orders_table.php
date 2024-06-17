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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('companies_id')->nullable(false);
            $table->unsignedBigInteger('masters_id')->nullable(false);
            $table->unsignedBigInteger('clients_id')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('works_id')->nullable(false);
            $table->string('motorcycles')->nullable(false);
            $table->dateTime('start_order');
            $table->dateTime('stop_order');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
