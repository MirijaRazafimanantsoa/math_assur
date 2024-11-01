<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateSinistresView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
           "
            CREATE VIEW sinistres_view AS
            SELECT
                cl.client_id,
                cl.nom,
                cl.prenom,
                c.num_contrat,
                c.type_contrat,
                c.montant_assure
            FROM
                contrats c
            JOIN
               clients cl ON cl.client_id = c.client_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS sinistres_view");
    }
}

