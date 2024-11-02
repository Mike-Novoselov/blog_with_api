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
        Schema::create('user_galleries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            // Внешний ключ для связи с таблицей users.
            // Метод constrained() автоматически добавит внешний ключ с ссылкой на поле id в таблице users,
            // а также применит каскадное удаление.

            $table->string('image_path'); // Путь к файлу изображения

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_galleries');
    }
};
