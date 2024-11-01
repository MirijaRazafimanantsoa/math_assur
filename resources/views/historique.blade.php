<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/HistoriqueStyle.css') }}">
    <title>Document</title>
</head>
<body>
    <nav>
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
        <h1>Historique des Modifications</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historiqueEntries as $entry)
                    <tr>
                        <td>{{ $entry->message }}</td>
                        <td> Le {{ $entry->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>