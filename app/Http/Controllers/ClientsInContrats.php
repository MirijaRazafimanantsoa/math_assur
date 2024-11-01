<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;

class AddContratController extends Controller
{
    public function getInfo()
    {
        $clients = Client::all();
        return response()->json([
            'clients' => $clients,
            
        ]);
    }
}

