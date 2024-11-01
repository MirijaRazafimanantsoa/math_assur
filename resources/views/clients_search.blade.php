<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
    <style>

/* Body Styles */
body {
    font-family: Arial, sans-serif; /* Set a clean sans-serif font */
    background: linear-gradient(90deg, #fed7a5, #9e6752); /* Gradient background */
    color: #343a40; /* Dark text color for contrast */
    margin: 0; /* Remove default margin */
    padding: 20px; /* Padding around the content */
    line-height: 1.6; /* Increase line height for better readability */
}


/* Navbar Styling */


.navbar {
    display: flex; /* Use flexbox for alignment */
    justify-content: space-between; /* Space between brand and links */
    align-items: center; /* Center items vertically */
    padding: 10px 20px; /* Padding for spacing */
    background: linear-gradient(90deg, #2d4354, #20212b); /* Gradient background */
    color: white; /* Text color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    border-radius: 10px; /* Soft shadow for depth */
}

.navbar-brand {
    padding: 10px 15px; /* Padding around links */
    transition: background-color 0.3s;/* Increase font size for brand */
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

.nav-link:hover , .navbar-brand:hover{
    background-color: rgba(255, 255, 255, 0.2); /* Light background on hover */
    border-radius: 5px; /* Rounded corners on hover */
}




.alert {
    padding: 15px; /* Padding inside the alert box */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 20px; /* Space below the alert */
    font-size: 16px; /* Font size */
    color: #fff; /* White text color */
    transition: opacity 0.3s ease; /* Smooth fade-in/out transition */
}

.success-alert {
    background-color: #28a745; /* Green color for success alert */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}


/* Table Styling */
.table {
    width: 100%; /* Full width */
    border-collapse: collapse; /* Remove gaps between cells */
    margin: 20px 0; /* Spacing above and below the table */
    font-family: Arial, sans-serif; /* Font style for the table */
}

/* Header Styling */
.table thead {
    background: linear-gradient(90deg, #9e6752, #534145); /* Gradient background */
    color: #fff; /* Header text color */
}

.table th {
    padding: 10px; /* Padding for table headers */
    text-align: left; /* Align header text to the left */
}

/* Body Row Styling */
.table tbody tr {
    border-bottom: 1px solid #ddd; /* Bottom border for rows */
}

/* Alternating Row Colors */
.table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Light gray for even rows */
}

.table tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.1); /* Light blue on hover */
}

/* Cell Padding */
.table td {
    padding: 10px; /* Padding for table cells */
}

.secondary-button {
    padding: 10px 15px; /* Button padding */
    font-size: 16px; /* Font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    background: linear-gradient(135deg, #73766a, #2d372f); /* Gradient for primary button */
    color: white; /* Button text color */
    transition: background-image 0.3s, transform 0.2s; /* Transition for hover effect */
}

.success-button {
    padding: 10px 15px; /* Button padding */
    margin-left: 5px;
    margin-right: 5px;
    font-size: 16px; /* Font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    background: linear-gradient(135deg, #73766a, #2d372f); /* Gradient for primary button */
    color: white; /* Button text color */
    transition: background-image 0.3s, transform 0.2s; /* Transition for hover effect */
}

.danger-button {
    padding: 10px 15px; /* Button padding */
    font-size: 16px; /* Font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    background-image: linear-gradient(to right, #dc3545, #c82333); /* Red gradient */
    color: white; /* Button text color */
    transition: background-image 0.3s, transform 0.2s; /* Transition for hover effect */
}

/* Hover effects */
.secondary-button:hover {
    background-image: linear-gradient(to right, #5a6268, #495057); /* Darker gray on hover */
}

.success-button:hover {
    background-image: linear-gradient(to right, #5a6268, #495057); /* Darker gray on hover */
}

.danger-button:hover {
    background-image: linear-gradient(to right, #c82333, #bd2130); /* Darker red on hover */
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
            @endif
            <a href="/sinistres" class="nav-link">Sinistres</a>
        </div>
        
    </nav>


<div class="container">
    <!-- Search Results Message -->
    @if(request()->has('query'))
        <p><h3>Résultats de la recherche pour "{{ request()->input('query') }}":</h3></p>
    @endif

    <!-- Check if there are any clients -->
    @if($clients->isEmpty())
        <h2><p>Aucun client trouvé.</p></h2>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nombre de contrats</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
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
    @endif
</div>
<script>

function toggleButtons(row) {
    const nextRow = row.nextElementSibling; // Get the next row (button row)
    
    // Toggle visibility of the button row
    if (nextRow.style.display === "none" || nextRow.style.display === "") {
        nextRow.style.display = "table-row"; // Show buttons
    } else {
        nextRow.style.display = "none"; // Hide buttons
    }
}
</script>
</body>
</html>