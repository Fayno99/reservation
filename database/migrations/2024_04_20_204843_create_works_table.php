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
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_of_work')->nullable(false);
            $table->string('description')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->unsignedBigInteger('time_for_work')->nullable(false);
            $table->boolean('active')->default(true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });

        DB::table('works')->insert([
            [
                'name_of_work' => 'Повна діагностика',
                'description' => 'Прям реально повна',
                'price' => 1200,
                'time_for_work' => 60,
            ],
            [
                'name_of_work' => 'Шиномонтаж',
                'description' => 'Заміна шин,балансування',
                'price' => 300,
                'time_for_work' => 40,
            ],
            [
                'name_of_work' => 'Чистка карбюратора',
                'description' => 'Чистка в ультразвуковій ванні, заміна жиклерів за необхідністю при налаштуванні',
                'price' => 400,
                'time_for_work' => 60,
            ],  [
                'name_of_work' => 'Чистка паливної магістралі',
                'description' => 'Чистка паливного баку, заміна фільтрів, діагностика насосу, чистка інжектора',
                'price' => 1200,
                'time_for_work' => 120,
            ],  [
                'name_of_work' => 'Зварювальні роботи',
                'description' => 'Званювання аргоном, чи вуглекислотою',
                'price' => 200,
                'time_for_work' => 20,
            ],  [
                'name_of_work' => 'Регулювання клапанів',
                'description' => 'Ціна регулювання залежить від кількості клапанів і важкості доступу',
                'price' => 300,
                'time_for_work' => 60,
            ],  [
                'name_of_work' => 'Ремонт коробки передач',
                'description' => 'Ремонт коробки перевірка на стенді',
                'price' => 5000,
                'time_for_work' => 400,
            ],  [
                'name_of_work' => 'Ремонт задньої підвіски',
                'description' => 'замані сальнків підшипників',
                'price' => 1000,
                'time_for_work' => 300,
            ], [
                'name_of_work' => 'Ремонт гальмівної системи',
                'description' => 'Ремонт гальмівних супортів',
                'price' => 1200,
                'time_for_work' => 240,
            ], [
                'name_of_work' => 'Передсезонне ТО',
                'description' => 'Замана гальмівних калодок, заміна масла, фільтра масляного, фільтра повітряного',
                'price' => 800,
                'time_for_work' => 180,
            ], [
                'name_of_work' => 'Електика',
                'description' => 'Заміна лампочок перевірка концевиків',
                'price' => 100,
                'time_for_work' => 30,
            ], [
                'name_of_work' => 'Електика',
                'description' => 'модифікація створення коригування будь якого єлектричного вузла',
                'price' => 1500,
                'time_for_work' => 100,
            ], [
                'name_of_work' => "Комп'ютерна діагностика",
                'description' => 'Перевірка сканаером або осцилографом',
                'price' => 500,
                'time_for_work' => 30,
            ], [
                'name_of_work' => 'Фарбування',
                'description' => 'Барбування як одної деталі так і всього мотоцикла, ціна вказана за велику деталь',
                'price' => 1500,
                'time_for_work' => 120,
            ], [
                'name_of_work' => 'Токарні і фрезерні роботи',
                'description' => 'Відновлення двигуна, форсування, чи розточка ЦПГ',
                'price' => 2000,
                'time_for_work' => 300,
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
