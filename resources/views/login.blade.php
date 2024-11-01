<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #fed7a5, #9e6752); /* Gradient background */
            margin: 0;
            padding: 20px;
            color: white;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background: linear-gradient(135deg, #73766a, #2d4354);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #fdfafa;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #f5efef;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049; /* Darker green */
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: #f5f4f4;
        }
        a {
    color: #3498db; /* Light blue color */
    text-decoration: none; /* Remove underline */
    font-weight: bold; /* Bold text */
    transition: color 0.3s ease, text-shadow 0.3s ease; /* Smooth transition */
}

a:hover {
    color: #2980b9; /* Darker blue on hover */
    text-shadow: 0px 0px 5px rgba(52, 152, 219, 0.7); /* Soft glowing effect */
    text-decoration: underline; /* Add underline on hover */
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>
        <div class="message">
            <p>Pas de compte? : <a href="{{ route('register') }}">Créer un compte @guest client @endguest</a></p>
        </div>
    </div>
</body>
</html>
