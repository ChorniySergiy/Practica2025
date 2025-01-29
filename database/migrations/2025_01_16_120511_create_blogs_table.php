<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Це створить автоінкрементний id для таблиці blogs
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('author_id'); // Змінюємо на unsignedBigInteger
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade'); // Зовнішній ключ до таблиці users
            $table->timestamps();
            $table->dateTime('publish_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

