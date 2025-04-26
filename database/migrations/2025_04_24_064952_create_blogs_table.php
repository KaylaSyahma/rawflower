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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('judul');
            $table->text('isi');
            $table->string('slug')->unique(); // biar bisa dipake di URL
            $table->string('excerpt'); // ringkasan buat preview
            $table->timestamp('published_at')->nullable(); // kalo mau draft dulu bisa null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
