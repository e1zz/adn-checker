<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dnaverifications', function (Blueprint $table) {
            $table->id();
            $table->text('dna'); // Guardamos la secuencia como JSON o texto
            $table->boolean('mutation'); // true/false
            $table->timestamps();

            $table->unique('dna'); // Evita duplicados por ADN
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dnaverifications');
    }
};

