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
        Schema::create('sinistres', function (Blueprint $table) {
            $table->id('num_sinistre');
            $table->date('date_incident');
            $table->date('date_declaration');
            $table->integer('montant_indemnise');
            $table->enum('etat', [0, 1])->default(0); // 0 tsotra , 1 validé
            $table->date('date_validation')->nullable();
            $table->string('description',50);
            $table->primary('num_sinistre');
            $table->unsignedBigInteger('num_contrat');
            $table->foreign('num_contrat')->references('num_contrat')->on('contrats'); 
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinistres');
    }
};
