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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('companyId');
            $table->string('token');
            $table->timestamps();
        });



    /**
     * Reverse the migrations.
     */
        DB::table('organizations')->insert([
            [
                'companyId' => '1',
                'token' => '1',
            ],
        ]);
    }


    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
