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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('description')->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
        DB::table('companies')->insert([
            [
                'name' => 'King Custom',
                'address' => 'Nord Street',
                'description' => 'Компанія заснована в 2014 році',
            ],
            [
                'name' => 'King Custom',
                'address' => 'West Street',
                'description' => 'Компанія заснована в 2016 році',
            ],

        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
