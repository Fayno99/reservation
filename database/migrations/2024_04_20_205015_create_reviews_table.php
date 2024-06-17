<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->unsignedBigInteger('stars');
            $table->unsignedBigInteger('masters_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });

        DB::table('reviews')->insert([
            [
                'text' => 'Крутяк зробили все швидко',
                'stars' => '5',
                'masters_id' => 1,
            ],
            [
                'text' => 'Майстер що треба кінь вже 3 дні їзде без бензіка',
                'stars' => '5',
                'masters_id' => 2,
            ],
            [
                'text' => 'Не протер фару перед здачою мото',
                'stars' => '4',
                'masters_id' => 3,
            ],
            [
                'text' => 'Все по феншую дякую',
                'stars' => '5',
                'masters_id' => 4,
            ],
            [
                'text' => 'Не встиг допити кофе вже все зробили',
                'stars' => '5',
                'masters_id' => 4,
            ],
            [
                'text' => 'Коли приїзджаю у сервіс мотоцикл самовідновлюється',
                'stars' => '5',
                'masters_id' => 2,
            ],
            [
                'text' => 'Тільки тут можуть відбалансувати колеса',
                'stars' => '5',
                'masters_id' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
