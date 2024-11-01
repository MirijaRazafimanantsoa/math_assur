<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails Contrat</title>
    <style>
    body {
    font-family: Arial, sans-serif; /* Set a clean sans-serif font */
    background: linear-gradient(90deg, #fed7a5, #9e6752); /* Gradient background */
    color: #ffffff; /* Dark text color for contrast */
    margin: 0; /* Remove default margin */
    padding: 20px; /* Padding around the content */
    line-height: 1.6; /* Increase line height for better readability */
}
.container {
    background: linear-gradient(90deg, #2d4354, #20212b); /* Gradient background */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Slightly stronger shadow */
    padding: 20px;
    max-width: 800px; /* Limit the width of the container */
    margin: auto; /* Center the container */
}

h1 {
    color: #ffffff; /* Dark gray color for headings */
    text-align: center; /* Center the heading */
    margin-bottom: 20px; /* Add space below the heading */
}

table {
    width: 100%; /* Full width for the table */
    border-collapse: collapse; /* Remove double borders */
    margin-top: 20px; /* Space above the table */
}

th, td {
    border: 1px solid #dee2e6; /* Light border for cells */
    padding: 12px; /* Padding inside cells */
    text-align: left; /* Left align text */
    transition: background-color 0.3s; /* Smooth transition for cell background */
}

th {
    background-color: #8ec3fcb0; /* Bootstrap primary color for headers */
    color: rgb(21, 21, 21); /* White text for header */
}

tr:nth-child(even) {
    background-color: rgba(238, 240, 241, 0.8); /* Light gray background for even rows */
}

tr:hover {
    background-color: rgba(0, 123, 255, 0.1); /* Light blue background on row hover */
}

a.btn {
    display: inline-block; /* Display block for button */
    padding: 10px 15px; /* Padding inside button */
    margin-top: 20px; /* Margin above the button */
    background-image: linear-gradient(to right, #007bff, #6c757d); /* Soft blue to gray gradient */
    color: white; /* White text */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners for button */
    transition: background-image 0.3s, transform 0.2s; /* Smooth transition */
}

a.btn:hover {
    background-image: linear-gradient(to right, #0056b3, #5a6268); /* Darker blue to gray gradient on hover */
    transform: scale(1.05); /* Slightly increase size on hover */
}

</style>
</head>
<body>
    
<div class="container">
    <h1>Détails du Client N° {{ $client->client_id }}</h1>
    
    <table class="table">
        <tr>
            <th>Nom</th>
            <td>{{ $client->nom }}</td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td>{{ $client->prenom }}</td>
        </tr>
        <tr>
            <th>Date de naissance</th>
            <td>{{ $client->date_de_naissance }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $client->adresse }}</td>
        </tr>
        <tr>
            <th>Contrats associés</th>
            <td>
                @if($client->contrats->isNotEmpty())
                    <ul>
                        @foreach($client->contrats as $contrat)
                            <li>Contrat N°{{ $contrat->num_contrat }} - Type: {{ $contrat->type_contrat }} -Assuré:{{ $contrat->montant_assure }}</li>
                        @endforeach
                    </ul>
                @else
                    Aucun contrat associé
                @endif
            </td>  
        </tr>
        <tr>
            <th>Total</th>
            <td>
                @if($client->contrats->isNotEmpty())
                @php
                    $totalMontantAssure = $client->contrats->sum('montant_assure');
                @endphp
                {{ $totalMontantAssure }} Ar
                @else
                0
                @endif
            </td>
        </tr>
        
    </table>

    <a href="{{ route('clients.index') }}" class="btn btn-primary">Retour à la liste des clients</a>
    <a href="{{ route('contrats.index') }}" class="btn btn-primary">Ajouter un contrat</a>

</div>


</body>
</html>