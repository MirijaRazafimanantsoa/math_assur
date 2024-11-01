<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Sinistre;

class CountsController extends Controller
{
    public function getCounts()
    {
        // Fetch counts from the database
        $clientsCount = Client::count();
        $contratsCount = Contrat::count();
        $sinistresCount = Sinistre::count();
        $clientsWithoutContratsCount = Client::doesntHave('contrats')->count();
        $vieContratsCount = Contrat::where('type_contrat', 'vie')->count();
        $nonVieContratsCount = Contrat::where('type_contrat', 'non_vie')->count();


        // Return as JSON
        return response()->json([
            'clientsCount' => $clientsCount,
            'contratsCount' => $contratsCount,
            'sinistresCount' => $sinistresCount,
            'clientsWithoutContratsCount' => $clientsWithoutContratsCount,
            'vieContratsCount' => $vieContratsCount,
            'nonVieContratsCount' => $nonVieContratsCount,
        ]);
    }
}

