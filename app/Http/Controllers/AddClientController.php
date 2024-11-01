<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class AddClientController extends Controller
{
    public function store (Request $request) {
        $validated = $request->validate([
            'nom'=>'required|string|max:100',
            'prenom'=>'required|string|max:100',
            'naissance'=>'required|date',
            'adresse'=>'required|string|max:100',
        ]);

        $client = new Client([
            'nom' => $validated['nom'],
            'prenom'=> $validated['prenom'],
            'date_de_naissance'=> $validated['naissance'],
            'adresse'=> $validated['adresse'],
        ]);
        $client -> save();
        return redirect()->route('clients.index')->with('success',"Client n°{$client->client_id} ajouté avec succès");
    }
    
}

