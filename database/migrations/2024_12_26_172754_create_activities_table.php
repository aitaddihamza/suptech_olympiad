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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'activité
            $table->text('description')->nullable(); // Description de l'activité
            $table->foreignId('user_id') // L'organisateur de l'activité
                  ->constrained('users') // Fait référence à l'id de la table users
                  ->onDelete('cascade'); // Supprime les activités si l'utilisateur est supprimé
            $table->timestamps();
            $table->date('date_debut');
            $table->date('date_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
