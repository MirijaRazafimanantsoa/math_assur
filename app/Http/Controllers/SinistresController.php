<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;

use App\Models\Sinistre;
use Illuminate\Http\Request;
use App\Models\SinistreView;

class SinistresController extends Controller
{
    public function index()
{
    // Eager load the 'client' relationship for each sinistre
    $Sinistres = Sinistre::all();

    return view('sinistres', compact('Sinistres'));
}


    public function store(Request $request)
{
    // 1. Validate the incoming request data
    $validatedData = $request->validate([
        'date_incident' => 'required|date',
        'date_declaration' => 'required|date',
        'montant_indemnise' => 'required|integer',
        'etat' => 'nullable|string',
        'date_validation' => 'nullable|date',
        'description' => 'required|string',
        'num_contrat' => 'required|integer',
    ]);

    // 2. Create a new sinistre using the validated data
    $sinistre = Sinistre::create($validatedData);
    // 4. Redirect with success message
    return redirect()->route('sinistres.index')->with('success', "Nouveau sinistre déclaré (n°{$sinistre->num_sinistre})");
}


public function declare()
{
    $contrats = Contrat::with('client')->get(); // Eager load clients for each contract
    return view('declarer_sinistre', compact('contrats'));
}

}
