<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('companies_id')->nullable(false);
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });


        DB::table('masters')->insert([
            [
                'name' => 'Микола',
                'companies_id' => '1',
                'image' => '1715373122.jpg',
            ],
            [
                'name' => 'Тарас',
                'companies_id' => '1',
                'image' => '1715372675.jpg',
            ],
            [
                'name' => 'Сергій',
                'companies_id' => '2',
                'image' => '1715372785.jpg',
            ],
            [
                'name' => 'Андрій',
                'companies_id' => '2',
                'image' => '1715373122.jpg',
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }





};
