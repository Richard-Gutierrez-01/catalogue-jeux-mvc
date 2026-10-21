<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de jeux - {{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    <link rel="icon" type="image/png" href="{{ asset }}/img/favicon.png">
</head>
<body>
    <nav>
        <a href="{{ base }}/" class="site-logo">
            <img src="{{ asset }}/img/favicon.png" alt="Accueil">
            <span>Catalogue de jeux</span>
        </a>
        <ul>
            <li><a href="{{ base }}/">Accueil</a></li>
            <li><a href="{{ base }}/jeu">Jeux</a></li>
            <li><a href="{{ base }}/developpeur">Développeurs</a></li>
            <li><a href="{{ base }}/plateforme">Plateformes</a></li>
        </ul>
    </nav>
    <main>
