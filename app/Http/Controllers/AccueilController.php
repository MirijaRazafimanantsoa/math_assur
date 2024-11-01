<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class AccueilController extends Controller
{  
    public function index (){
        return view('accueil',
    ['clients'=>Client::all()]);
    }
}
