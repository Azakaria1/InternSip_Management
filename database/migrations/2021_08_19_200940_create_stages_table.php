<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('statut_id')->constrained('statuts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('stagiaire_id')->constrained('stagiaires')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sujet_id')->constrained('sujets')->onUpdate('cascade')->onDelete('cascade');
            $table->string('prenom_ajoute_par');
            $table->string('nom_ajoute_par');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }
}