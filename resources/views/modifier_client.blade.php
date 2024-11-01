<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/ModifierClient.css') }}">
    <title>Modifier Client</title>
</head>
<body>
    <h1>Modifier le Client N° {{ $client->client_id }}</h1>

    <!-- Form for Client -->
    <form action="{{ route('client.update', $client->client_id) }}" method="POST" class="client-form">
        @csrf
        @method('PUT')

        <!-- Client fields -->
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ $client->nom }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ $client->prenom }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="date_de_naissance">Date de Naissance:</label>
            <input type="date" id="date_de_naissance" name="date_de_naissance" value="{{ $client->date_de_naissance }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" value="{{ $client->adresse }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</body>
</html>
