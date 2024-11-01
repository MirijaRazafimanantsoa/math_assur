<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Déclaration sinistre</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Set a clean sans-serif font */
            background: linear-gradient(90deg, #fed7a5, #9e6752); /* Gradient background */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Padding around the content */
        }

        h1 {
            text-align: center; /* Center the title */
            color: #333; /* Dark color for the title */
            margin-bottom: 20px; /* Space below the title */
        }

        .form-group {
            margin-bottom: 15px; /* Space between form groups */
        }

        label {
            display: block; /* Make label occupy full width */
            margin-bottom: 5px; /* Space below the label */
            color: #555; /* Darker color for labels */
        }

        input[type="date"],
        input[type="number"],
        select,
        .btn {
            width: 100%; /* Full width */
            padding: 10px; /* Padding */
            border: 1px solid #ccc; /* Border color */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            font-size: 16px; /* Font size */
        }

        input[type="date"]:focus,
        input[type="number"]:focus,
        select:focus,
        .btn:focus {
            border-color: #007bff; /* Highlight border on focus */
            outline: none; /* Remove default outline */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Highlight shadow on focus */
        }

        .btn {
            background-color: #007bff; /* Button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth transition for background */
        }

        .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .container {
            max-width: 600px; /* Max width for the form */
            margin: auto; /* Center the form */
            background: white; /* White background for the form */
            padding: 20px; /* Padding inside the form */
            border-radius: 10px; /* Rounded corners for the form */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }/* Shadow for depth */

.navbar {
    display: flex; /* Use flexbox for alignment */
    justify-content: space-between; /* Space between brand and links */
    align-items: center; /* Center items vertically */
    padding: 10px 20px; /* Padding for spacing */
    background: linear-gradient(90deg, #2d4354, #20212b); /* Gradient background */
    color: white; /* Text color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    border-radius: 10px; /* Soft shadow for depth */
    margin-bottom: 0.5em; 
}

.navbar-brand {
    font-size: 1.5rem; /* Increase font size for brand */
    font-weight: bold; /* Bold text for emphasis */
}

.navbar-links {
    display: flex; /* Use flexbox for links alignment */
}

.nav-link {
    color: white; /* White text for links */
    text-decoration: none; /* Remove underline */
    padding: 10px 15px; /* Padding around links */
    transition: background-color 0.3s; /* Smooth transition for background */
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Light background on hover */
    border-radius: 5px; /* Rounded corners on hover */
}


        }
    </style>
</head>
<body>
    
<nav class="navbar">
        <a href="{{ route('accueil.index') }}" class="navbar-brand" style="text-decoration: none; color: inherit;">Accueil</a>
        <div class="navbar-links">
            @if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))
            <a href="/clients" class="nav-link">Clients</a>
            <a href="/contrats" class="nav-link">Contrats</a>
            <a href="/sinistres" class="nav-link">Sinistres</a>
            @endif
        </div>
 </nav>

<div class="container">
    <h1>Déclaration de Sinistre</h1>
    <form action="{{ route('sinistres.store') }}" method="POST">
        @csrf
        <div class="form-group">
        <label for="num_contrat" class="form-label">Numéro de contrat</label>
        <select class="form-control" id="num_contrat" name="num_contrat" required>
            <option value=""></option>
            @foreach($contrats as $contrat)
                <option value="{{ $contrat->num_contrat }}">
                    {{ $contrat->client->nom }} {{ $contrat->client->prenom }} - Contrat n°{{ $contrat->num_contrat }} ({{ $contrat->type_contrat }} - {{ $contrat->montant_assure}} Ar)
                </option>
            @endforeach
        </select>
    </div>

        <div class="form-group">
            <label for="date_incident" class="form-label">Date de l'incident</label>
            <input type="date" class="form-control" id="date_incident" name="date_incident" required>
        </div>

        <div class="form-group">
            <label for="date_declaration" class="form-label">Date de déclaration</label>
            <input type="date" class="form-control" id="date_declaration" name="date_declaration" required>
        </div>

        <div class="form-group">
            <label for="montant_indemnise" class="form-label">Montant indemnisé</label>
            <input type="number" class="form-control" id="montant_indemnise" name="montant_indemnise" required>
        </div>



        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>

</body>
</html>
