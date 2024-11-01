<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historique;

class HistoriqueController extends Controller
{
    public function index()
{
    // Fetch records from the correct table
    $historiqueEntries = Historique::orderBy('created_at', 'desc')->get();

    return view('historique', compact('historiqueEntries'));
}

public function getLastModifications()
{
    // Fetch the latest 5 modifications from the historique table
    $lastModifications = Historique::orderBy('created_at', 'desc')->take(5)->get();

    // Return the data as a JSON response
    return response()->json($lastModifications);
}
}
