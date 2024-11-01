<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/ModifierContrat.css') }}">
    <title>Document</title>
</head>
<body>
    <h1>Modifier le Contrat N° {{ $contrat->num_contrat }}</h1>
    <form action="{{ route('contrat.update', $contrat->num_contrat) }}" method="POST" class="contrat-form">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="type_contrat">Type de contrat:</label>
            <select id="type_contrat" name="type_contrat" class="form-control">
                <option value="vie" {{ $contrat->type_contrat === 'vie' ? 'selected' : '' }}>Vie</option>
                <option value="non_vie" {{ $contrat->type_contrat === 'non_vie' ? 'selected' : '' }}>Non Vie</option>
            </select>
        </div>
    
        <div class="form-group">
            <label for="date_souscription">Date de souscription:</label>
            <input type="date" id="date_souscription" name="date_souscription" value="{{ $contrat->date_souscription }}" class="form-control">
        </div>
    
        <div class="form-group">
            <label for="montant_assure">Montant assuré:</label>
            <input type="number" id="montant_assure" name="montant_assure" value="{{ $contrat->montant_assure }}" class="form-control">
        </div>
    
        <div class="form-group">
            <label for="duree_du_contrat">Durée du contrat:</label>
            <input type="text" id="duree_du_contrat" name="duree_du_contrat" value="{{ $contrat->duree_du_contrat }}" class="form-control">
        </div>
    
        <div class="form-group">
            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" class="form-control" required>
        <!-- Client options will be dynamically populated here -->
    </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
    
    
    <script>
        // Populate the client dropdown on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/client-info')
                .then(response => response.json())
                .then(data => {
                    const clientIdSelect = document.getElementById('client_id');
                    clientIdSelect.innerHTML = ''; // Clear previous options

                    data.clients.forEach(client => {
                        const option = document.createElement('option');
                        option.value = client.client_id;
                        option.textContent = `${client.nom} ${client.prenom} (ID = ${client.client_id})`;
                        // Select the current client if it matches the contrat's client_id
                        if (client.client_id == "{{ $contrat->client_id }}") {
                            option.selected = true;
                        }
                        clientIdSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching client data:', error);
                });
        });
    </script>

</body>
</html>