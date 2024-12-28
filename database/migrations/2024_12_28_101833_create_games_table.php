<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id'); // Référence à l'activité
            $table->dateTime('game_date'); // Date et heure du match
            $table->string('status')->default('pending'); // État du match (e.g., pending, in_progress, finished)
            $table->json('scores')->nullable(); // Stocker les scores des joueurs sous forme de JSON
            $table->timestamps();

            // Contraintes
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
