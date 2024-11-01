<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrats</title>
    <link rel="stylesheet" href="{{ asset('css/ContratsStyle.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('accueil.index') }}" class="navbar-brand" style="text-decoration: none; color: inherit;">Accueil</a>
        <div class="navbar-links">
            <a href="/clients" class="nav-link">Clients</a>
            <a href="/contrats" class="nav-link">Contrats</a>
            <a href="/sinistres" class="nav-link">Sinistres</a>
        </div>
    </nav>
    @if (session()->has('success'))
<div class="alert success-alert">
    {{ session('success') }}
</div>
@endif
    <div class="header-container">
        <h1>Liste des contrats</h1>
        <button class="add-button" onclick="popupAddContrat()">Ajouter contrat</button>
    </div>

    <div class="table-container">
        <table class="client-table">
            <thead>
                <tr>
                    <th>N° de Contrat</th>
                    <th>Type de Contrat</th>
                    <th>Date de Souscription</th>
                    <th>Montant Assuré </th>
                    <th>Durée du Contrat </th>
                    <th>id Client</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Contrats as $contrat)
                <tr class="contrat-row" onclick="toggleButtons(this)">
                    <td>{{ $contrat->num_contrat }}</td>
                    <td>{{ $contrat->type_contrat }}</td>
                    <td>{{ $contrat->date_souscription }}</td>
                    <td>{{ $contrat->montant_assure }} Ar</td>
                    <td>{{ $contrat->duree_du_contrat }} Mois</td>
                    <td>{{ $contrat->client_id }}</td>
                </tr>
                <tr class="button-row" style="display:none;">
                    <td colspan="7" style="text-align: right;">
                        <div class="button-container" style="display: flex; align-items: center; gap: 10px;">
                            <form action="{{ route('detailsContrat', $contrat->num_contrat) }}" method="GET" style="display: block; margin: 0;">
                                <button class="secondary-button" >
                                    Details
                                </button>
                            </form>
                        
                            <form action="{{ route('contrat.edit', $contrat->num_contrat) }}" method="GET" style="display: block; margin: 0;">
                                <button class="success-button" >
                                    Modifier
                                </button>
                            </form>
                        
                            <form action="{{ route('contrats.destroy', $contrat->num_contrat) }}" method="POST" style="display: block; margin: 0;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button class="danger-button" >
                                    Supprimer
                                </button>
                            </form>
                        </div>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <div id="addContratModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeForm()">&times;</span>
            <h2>Ajouter un Contrat</h2>
            <form id="contratForm" action="{{ route('contrat.add') }}" method="POST">
                @csrf
                
                <label for="contratType">Type de Contrat:</label>
                <select id="contratType" name="type_contrat" required>
                    <option value="vie">Vie</option>
                    <option value="non_vie">Non Vie</option>
                </select>
        
                <label for="contratDateSouscription">Date de Souscription:</label>
                <input type="date" id="contratDateSouscription" name="date_souscription" required>
        
                <label for="contratMontantAssure">Montant Assuré (en Ariary):</label>
                <input type="number" id="contratMontantAssure" name="montant_assure" required>
        
                <label for="contratDuree">Durée du Contrat (en mois):</label>
                <input type="number" id="contratDuree" name="duree_du_contrat" required min="1">
        
                <label for="clientId">Client:</label>
                <select id="client_id" name="client_id" required>
        <!-- Client options will be dynamically populated here -->
    </select>
        
                <button type="submit">Ajouter</button>
                <button type="button" onclick="closeForm()">Annuler</button>
            </form>
        </div>
    </div>
    
    <script>
       function popupAddContrat() {
    fetch('/client-info')
        .then(response => response.json())
        .then(data => {
            const clientIdSelect = document.getElementById('client_id');
            clientIdSelect.innerHTML = ''; // Clear previous options

            data.clients.forEach(client => {
                const option = document.createElement('option');
                option.value = client.client_id;
                option.textContent = `${client.nom} ${client.prenom} (ID = ${client.client_id})`;
                clientIdSelect.appendChild(option);
            });

            // Show the modal
            document.getElementById('addContratModal').style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching client data:', error);
        });
}

    
        function closeForm() {
            // Hide the modal
            document.getElementById('addContratModal').style.display = 'none';
        }
    
        // Optional: Close the modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('addContratModal');
            if (event.target === modal) {
                closeForm();
            }
        }
        function toggleButtons(row) {
    const nextRow = row.nextElementSibling; // Get the next row (button row)
    if (nextRow && nextRow.classList.contains('button-row')) {
        // Toggle display of the button row
        if (nextRow.style.display === "none") {
            nextRow.style.display = "table-row"; // Show the button row
        } else {
            nextRow.style.display = "none"; // Hide the button row
        }
    }
}      
 function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer ce contrat ?");
    }

    </script>
    
    
</body>
</html>
