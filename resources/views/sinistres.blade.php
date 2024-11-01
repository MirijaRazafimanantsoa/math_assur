<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sinistres</title>
    <link rel="stylesheet" href="{{ asset('css/SinistresStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.theme.min.css') }}">
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>

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
    @if (session('success'))
    <div class="alert success-alert">
        {{ session('success') }}
    </div>
@endif

    <div class="header-container">
        <h1>Liste des sinistres déclarés</h1>
<form action="{{ route('declarerSinistre') }}">
    <button class="add-button" onclick="popupAddSinistre()">Declarer sinistre</button>

</form>
    </div>
    
    
    <table>
        <thead>
            <tr>
                <th>N° de sinistre</th>
                <th>Date de Déclaration</th>
                <th>Montant indemnisé (Ar)</th>
                <th>N° Contrat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Sinistres as $sinistre)
                <tr class="sinistre-row" onclick="toggleButtons(this)">
                    <td>{{ $sinistre->num_sinistre }}</td>
                    <td>{{ $sinistre->date_declaration }}</td>
                    <td>{{ $sinistre->montant_indemnise }}</td>
                    <td>{{ $sinistre->num_contrat }}</td>
                </tr>
            @endforeach

        
</body>
</html>