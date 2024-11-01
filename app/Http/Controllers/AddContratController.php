<?php

namespace App\Http\Controllers;

use App\Models\Contrat; // Import the Contrat model
use Illuminate\Http\Request;

class AddContratController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'type_contrat' => 'required|in:vie,non_vie', // Validate type of contract
            'date_souscription' => 'required|date', // Validate subscription date
            'montant_assure' => 'required|numeric', // Validate insured amount
            'duree_du_contrat' => 'required|integer|min:1', // Validate duration as a positive integer
            'client_id' => 'required|exists:clients,client_id', // Ensure client_id exists in clients table
        ]);
    
        // Create a new Contrat instance with validated data
        $contrat = new Contrat([
            'type_contrat' => $validated['type_contrat'],
            'date_souscription' => $validated['date_souscription'],
            'montant_assure' => $validated['montant_assure'],
            'duree_du_contrat' => $validated['duree_du_contrat'],
            'client_id' => $validated['client_id'],
        ]);
        
        $contrat->save();
    
        // Redirect with success message including the generated contract number
        return redirect()->route('contrats.index')->with('success', "Contrat n°{$contrat->num_contrat} ajouté avec succès");
    }
    
    public function destroy($num_contrat) {
        $contrat = Contrat::where('num_contrat', $num_contrat)->first();
    
        if ($contrat) {
            $contrat->delete();
            return redirect()->route('contrats.index')->with('success', "Contrat n°{$contrat->num_contrat} supprimé avec succès");
        } else {
            return redirect()->route('contrats.index')->with('error', 'Contrat non trouvé');
        }
    }

    public function create()
    {
        $clients = Client::all(); // Retrieve all clients
        return view('contrats', compact('clients')); // Pass clients to the view
    }
    
}
