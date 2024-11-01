<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
{
    // Eager load 'contrats' relationship to access the number of contracts easily
    $Clients = Client::with('contrats')->get();

    return view('clients', compact('Clients'));
}
public function edit($client_id)
{
    $client = Client::findOrFail($client_id);
    return view('modifier_client', compact('client'));
}

public function update(Request $request, $client_id)
{
    // Validate the incoming request data
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_de_naissance' => 'required|date',
        'adresse' => 'required|string|max:255',
        'type_contrat' => 'required|string|in:vie,non_vie',
    ]);

    // Find the client by their primary key (id)
    $client = Client::findOrFail($client_id);

    // Update the client fields with the validated data
    $client->nom = $request->input('nom');
    $client->prenom = $request->input('prenom');
    $client->date_de_naissance = $request->input('date_de_naissance');
    $client->adresse = $request->input('adresse');
    $client->type_contrat = $request->input('type_contrat');

    // Save the changes to the database
    $client->save();

    // Redirect back to the clients index page with a success message
    return redirect()->route('clients.index')->with('success', "Client N°{$client->client_id} modifié avec succès");
}

public function showDetails($client_id)
{
    // Eager load the 'contrats' relationship
    $client = Client::with('contrats')->findOrFail($client_id);

    // Pass the client data, along with related contracts, to the view
    return view('details_clients', compact('client'));
}

public function search(Request $request)
{
    $query = $request->input('query');
    
    $clients = Client::where('nom', 'LIKE', "%{$query}%")
        ->orWhere('prenom', 'LIKE', "%{$query}%")
        ->get();

    return view('clients_search', compact('clients'));
}

}