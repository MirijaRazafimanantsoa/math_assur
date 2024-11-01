<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id('num_contrat'); 
            $table->enum('type_contrat', ['vie', 'non_vie']); 
            $table->date('date_souscription'); 
            $table->bigInteger('montant_assure');
            $table->integer('duree_du_contrat'); 
            $table->unsignedBigInteger('client_id'); 
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('contrats');
    }
}
