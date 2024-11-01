<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clients</title>
    <link rel="stylesheet" href="{{ asset('css/ClientsStyle.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('accueil.index') }}" class="navbar-brand" style="text-decoration: none; color: inherit;">Accueil</a>
        <div class="navbar-links">
            @if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))

            <a href="/clients" class="nav-link">Clients</a>
            <a href="/contrats" class="nav-link">Contrats</a>
            @endif
            <a href="/sinistres" class="nav-link">Sinistres</a>
        </div>
        
    </nav>
    
    

@if (session()->has('success'))
<div class="alert success-alert">
    {{ session('success') }}
</div>
@endif
    
<div class="header-container">
    <h1 class="dashboard-title">Liste des clients</h1>
    <div class="search">
        <form action="{{ route('clients.search') }}" method="GET" class="search-form">
            <input type="text" name="query" class="search-input" placeholder="Rechercher nom/prénom" aria-label="Rechercher" />
            <button class="search-button">Rechercher</button>
        </form>
    </div>
    @if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))

    <button class="add-button primary-button" onclick="popupAddClient()">Ajouter</button>
    @endif
</div>

<table class="client-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Nombres de Contrats</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Clients as $client)
            <tr class="client-row" onclick="toggleButtons(this)">
                <td>{{ $client->client_id }}</td>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->prenom }}</td>
                <td>{{ $client->contrats->count() }}</td>
            </tr>
            @if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))

            <tr class="button-row" style="display:none;">
                <td colspan="6" style="text-align: right;">
                    <div class="button-container">
                    <form action="{{ route('contrats.index') }}" method="GET" style="display:inline-block; margin-right: 10px;">
                            <button class="details-button secondary-button">Ajouter un contrat</button>
                        </form>    
                    <form action="{{ route('detailsClient', $client->client_id) }}" method="GET" style="display:inline-block; margin: 0;">
                            <button class="details-button secondary-button">Détails</button>
                        </form>
                        <form action="{{ route('client.edit', $client->client_id) }}" method="GET" style="display:inline-block; margin: 0;">
                            <button class="modifier-button success-button">Modifier</button>
                        </form>
                        <form action="{{ route('client.destroy', $client->client_id) }}" method="POST" style="display:inline-block; margin: 0;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                            @csrf
                            @method('DELETE')
                            <button class="supprimer-button danger-button">Supprimer</button>
                        </form>
                        
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

<div id="addClientModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeForm()">&times;</span>
        <h2>Ajouter un Client</h2>
        <form id="clientForm" action="{{ route ('client.add') }}" method="POST">
            @csrf
            <label for="clientNom">Nom:</label>
            <input type="text" id="clientNom" name="nom" required>

            <label for="clientPrenom">Prénom:</label>
            <input type="text" id="clientPrenom" name="prenom" required>

            <label for="clientDateNaissance">Date de Naissance:</label>
            <input type="date" id="clientDateNaissance" name="naissance" required>

            <label for="clientAdresse">Adresse:</label>
            <input type="text" id="clientAdresse" name="adresse" required>

            <label for="clientTypeContrat">Type de Contrat:</label>
            <select id="clientTypeContrat" name="typecontrat" required>
                <option value="vie">Vie</option>
                <option value="non_vie">Non Vie</option>
            </select>

            <button type="submit">Ajouter</button>
            <button type="button" onclick="closeForm()">Annuler</button>
        </form>
    </div>
</div>




<script>
    function popupAddClient() {
    document.getElementById('addClientModal').style.display = 'flex'; // Show the modal
}

function closeForm() {
    document.getElementById('addClientModal').style.display = 'none'; // Hide the modal
}

function toggleButtons(row) {
    const nextRow = row.nextElementSibling; // Get the next row (button row)
    
    // Toggle visibility of the button row
    if (nextRow.style.display === "none" || nextRow.style.display === "") {
        nextRow.style.display = "table-row"; // Show buttons
    } else {
        nextRow.style.display = "none"; // Hide buttons
    }
}

function showDetails(clientId) {
    alert('Show details for client ID: ' + clientId);
}

function editClient(clientId) {
    alert('Edit client with ID: ' + clientId);
}

function deleteClient(clientId) {
    if (confirm('Are you sure you want to delete this client?')) {
        // Redirect or make an AJAX call to delete the client
        alert('Client with ID ' + clientId + ' has been deleted.');
    }
}

</script>

</body>
</html>