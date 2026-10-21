{{ include('layouts/header.php', {title: 'Erreur'}) }}
    <h1>Erreur</h1>
    <h2>{{ msg }}</h2>
    <a href="{{ base }}/" class="btn">Retour à l'accueil</a>
{{ include('layouts/footer.php') }}
