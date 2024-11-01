<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCAVNV</title>
    <link rel="stylesheet" href="{{ asset('css/AccueilStyle.css') }}">
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">Math Assur</div>
        <div class="navbar-links">
            @auth
            @if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))
            <a href="/clients" class="nav-link">Clients</a>
            <a href="/contrats" class="nav-link">Contrats</a>
            <a href="/sinistres" class="nav-link">Sinistres</a>
            <a href="/register" class="nav-link">Créer un compte </a>
            <a href="#profile" class="nav-link">
    Session actuelle : {{ Auth::user()->name }} ({{ Auth::user()->user_type }})</a>
            @else
            <a href="{{ route('declarerSinistre') }}" class="nav-link">Déclarer un sinistre</a>
            @endif
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="logout-btn">Se déconnecter</button>
            </form>
            
            @endauth
            @guest
            <a href="/login" class="nav-link">Se connecter</a>
            <a href="/register" class="nav-link">Créer un compte client </a>

            @endguest
        </div>
    </nav>

   
    @if (session()->has('success'))
<div class="alert success-alert">
    {{ session('success') }}
</div>
@endif
@guest
<h1 class="dashboard-title">Math Assur. Votre sécurité, notre priorité. </h1>
<div class="card-container">
    <div class="card primary" style="text-decoration: none; color: white;">
        <p><h4>Nombre de clients</h4></p>
        <h3 id="clientsCount">0</h3>
        <p><h5>Clients sans contrats</h5></p>
        <h4 id="clientsWithoutContratsCount">0</h4>
    </div>
    
    

    <div class="card success" style="text-decoration: none; color: white;">
        <p><h4>Nombre de contrats</h4></p>
        <h3 id="contratsCount">0</h3>
        <p><h5>Contrats Vie</h5></p>
        <h4 id="vieContratsCount">0</h4>
        <p><h5>Contrats Non Vie</h5></p>
        <h4 id="nonVieContratsCount">0</h4>
    </div>
    
    

    <div class="card danger" style="text-decoration: none; color: white;">
        <p><h4>Nombre de sinistres</h4></p>
        <h3 id="sinistresCount">0</h3>
    </div>
    

</div>
@endguest
@auth
@if(auth()->check() && in_array(auth()->user()->user_type, ['agent', 'administrateur']))

    <!-- Dashboard Content -->
        <h1 class="dashboard-title">Gestion des contrats d'assurance vie et non vie</h1>

    <div class="card-container">
        <a href="{{ route('clients.index') }}" class="card primary" style="text-decoration: none; color: white;">
            <p>Nombre de clients</p>
            <h2 id="clientsCount">0</h2>
            <p>Clients sans contrats</p>
            <h3 id="clientsWithoutContratsCount">0</h3>
        </a>
        
        
    
        <a href="{{ route('contrats.index') }}" class="card success" style="text-decoration: none; color: white;">
            <p>Nombre de contrats</p>
            <h2 id="contratsCount">0</h2>
            <p>Contrats Vie</p>
            <h3 id="vieContratsCount">0</h3>
            <p>Contrats Non Vie</p>
            <h3 id="nonVieContratsCount">0</h3>
        </a>
        
        
    
        <a href="{{ route('sinistres.index') }}" class="card danger" style="text-decoration: none; color: white;">
            <p>Nombre de sinistres</p>
            <h2 id="sinistresCount">0</h2>
        </a>
        
    
    </div>

    <div class="actions">
        <button class="primary-button" onclick="popupAddClient()">Ajouter un client</button>
        <button class="success-button" onclick="redirectToContrats()">Ajouter un contrat</button>
        <form action="{{ route("historique.index") }}">
            <button class = "secondary-button">Voir historique complet</button>
        </form>
    </div>
    <!-- Last Modifications in Contrats -->
    <div class="card historique">
        <h3>Dernières modifications</h3>
        <ul id="lastContratsModifications" class="list-group">
            <!-- Dynamic content will be inserted here -->
        </ul>
    </div>
@else
<h1 class="dashboard-title">Math Assur. Votre sécurité, notre priorité. </h1>
<div class="card-container">
    <div class="card primary" style="text-decoration: none; color: white;">
        <p><h4>Nombre de clients</h4></p>
        <h3 id="clientsCount">0</h3>
        <p><h5>Clients sans contrats</h5></p>
        <h4 id="clientsWithoutContratsCount">0</h4>
    </div>
    
    

    <div class="card success" style="text-decoration: none; color: white;">
        <p><h4>Nombre de contrats</h4></p>
        <h3 id="contratsCount">0</h3>
        <p><h5>Contrats Vie</h5></p>
        <h4 id="vieContratsCount">0</h4>
        <p><h5>Contrats Non Vie</h5></p>
        <h4 id="nonVieContratsCount">0</h4>
    </div>
    
    

    <div class="card danger" style="text-decoration: none; color: white;">
        <p><h4>Nombre de sinistres</h4></p>
        <h3 id="sinistresCount">0</h3>
    </div>
    

</div>
@endif

    
    <!-- Modal for Adding Client -->
    <div id="addClientModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeFormClient()">&times;</span>
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
    
    
                <button type="submit">Ajouter</button>
                <button type="button" onclick="closeFormClient()">Annuler</button>
            </form>
        </div>
    </div>
    
    
    
</body>
@endauth

<footer class="footer-container">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Math Assur</h3>
            <p>Gestion des contrats d'assurance vie et non vie avec une expertise éprouvée.</p>
        </div>

        <div class="footer-section">
            <h4>Informations</h4>
            <ul>
                <li><a href="#">Conditions Générales</a></li>
                <li><a href="#">Politique de Confidentialité</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contacts</h4>
            <p>Email: contact@mathassur.com</p>
            <p>Téléphone: +261 20 22 451 38</p>
            <p>Support: <a href="#">Page Support</a></p>
        </div>

        <div class="footer-section">
            <h4>Nos bureaux</h4>
            <ul>
                <li>Université d'Antananarivo</li>
                <li>Ankorondrano</li>
            </ul>
        </div>
    </div>
</footer>
<script>
    fetch('/dashboard-data')
     .then(response => response.json())
     .then(data => {
         // Update the HTML with the counts
         document.getElementById('clientsCount').textContent = data.clientsCount;
         document.getElementById('contratsCount').textContent = data.contratsCount;
         document.getElementById('sinistresCount').textContent = data.sinistresCount;document.getElementById('clientsWithoutContratsCount').textContent = data.clientsWithoutContratsCount;
         document.getElementById('clientsWithoutContratsCount').textContent = data.clientsWithoutContratsCount;
         document.getElementById('vieContratsCount').textContent = data.vieContratsCount;
         document.getElementById('nonVieContratsCount').textContent = data.nonVieContratsCount;
     })
     .catch(error => console.error('Error fetching data:', error));


     function popupAddClient() {
 document.getElementById('addClientModal').style.display = 'flex'; // Show the modal
}

function closeFormClient() {
 // Hide the modal
 document.getElementById("addClientModal").style.display = "none";
}


function redirectToHistoric() {
 window.location.href = '/historic'; // Redirect to the historic page
}

 
     // Optional: Close the modal when clicking outside of it
     window.onclick = function(event) {
         const modal = document.getElementById('addContratModal');
         if (event.target === modal) {
             closeForm();
         }
     }

     
 
 async function fetchLastModifications() {
     try {
         const response = await fetch('/last-modifications'); // Adjust the URL as necessary
         if (!response.ok) {
             throw new Error('Erreur de connection');
         }
         const modifications = await response.json();

         // Get the list element
         const list = document.getElementById('lastContratsModifications');

         // Clear the list before adding new items
         list.innerHTML = '';

         // Loop through the modifications and add them to the list
         modifications.forEach(mod => {
             const listItem = document.createElement('li');
             listItem.className = 'list-group-item';
             listItem.textContent = `${mod.message} le ${new Date(mod.created_at).toLocaleDateString('fr-FR')}`;
             list.appendChild(listItem);
         });
     } catch (error) {
         console.error('Erreur de connection:', error);
     }
 }
 function redirectToContrats() {
    // Redirect to the "Ajouter un contrat" page
    window.location.href = '/contrats'; // Adjust the URL as necessary
}
 
 fetchLastModifications();
</script>
</html>
