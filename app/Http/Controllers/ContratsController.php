<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Contrat;
use Illuminate\Http\Request;

class ContratsController extends Controller
{
    public function index (){
        

        return view('contrats',[
            'Contrats' => Contrat::all()
        ]);
    }

    public function edit($num_contrat)
{
    $contrat = Contrat::findOrFail($num_contrat); // Assuming 'Contrat' is your model
    return view('modifier_contrat', compact('contrat'));
}

public function update(Request $request, $num_contrat)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'type_contrat' => 'required|in:vie,non_vie', // Validate type of contract
        'date_souscription' => 'required|date', // Validate subscription date
        'montant_assure' => 'required|numeric', // Validate insured amount
        'duree_du_contrat' => 'required|integer|min:1', // Validate duration as a positive integer
        'client_id' => 'required|exists:clients,client_id', // Ensure client_id exists in clients table
    ]);

    // Find the contract by its primary key
    $contrat = Contrat::findOrFail($num_contrat);

    // Update the contract fields with the validated data
    $contrat->type_contrat = $validated['type_contrat'];
    $contrat->date_souscription = $validated['date_souscription'];
    $contrat->montant_assure = $validated['montant_assure'];
    $contrat->duree_du_contrat = $validated['duree_du_contrat'];
    $contrat->client_id = $validated['client_id'];

    $contrat->save();

    // Redirect with success message including the updated contract number
    return redirect()->route('contrats.index')->with('success', "Contrat n°{$contrat->num_contrat} modifié avec succès");
}


public function showDetails($num_contrat)
{
    // Find the contract by its primary key
    $contrat = Contrat::findOrFail($num_contrat);

    $dateSouscription = Carbon::parse($contrat->date_souscription);
    $dureeDuContrat = $contrat->duree_du_contrat; 
    $finDeContrat = $dateSouscription->addMonths($dureeDuContrat)->format('Y-m-d');
    return view('details_contrat', compact('contrat', 'finDeContrat'));

}

public function getInfo()
{
    $clients = Client::select('client_id', 'nom', 'prenom')->get();
    return response()->json([
        'clients' => $clients,
    ]);
}


}
