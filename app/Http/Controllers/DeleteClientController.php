<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class DeleteClientController extends Controller
{
    public function destroy($client_id) {
    $client=Client::where('client_id',$client_id)->first();
    $client->delete();
    return redirect()->route('clients.index')->with('success',"Client n°{$client->client_id} suprimé avec succès");
    }
}
