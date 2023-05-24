

<html>
<head>
    <meta charset="utf-8">
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h1>Bonjour {{ $name }},</h1>
    
    <p>Vous avez demandé la réinitialisation de votre mot de passe. Veuillez cliquer sur le lien ci-dessous pour procéder à la réinitialisation :</p>
    
    <a href="http://127.0.0.1:8000/login/changePassword/{{$activation_token}}">Réinitialiser le mot de passe</a>
    
    <p>Si vous n'avez pas effectué cette demande, vous pouvez ignorer cet e-mail.</p>
    
    <p>Merci,<br>
    Votre équipe {{ config('app.name') }}</p>
</body>
</html>