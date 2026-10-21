{{ include('layouts/header.php', {title: 'Modifier le développeur'}) }}
    <div class="container">
        <form method="post">
            <h2>Modifier le développeur</h2>
            <label>Nom
                <input type="text" name="nom" value="{{ developpeur.nom }}">
            </label>
            {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}
            <label>Pays d'origine
                <input type="text" name="pays_origine" value="{{ developpeur.pays_origine }}">
            </label>
            {% if errors.pays_origine is defined %}<span class="error">{{ errors.pays_origine }}</span>{% endif %}
            <label>Date de fondation
                <input type="date" name="date_fondation" value="{{ developpeur.date_fondation }}">
            </label>
            {% if errors.date_fondation is defined %}<span class="error">{{ errors.date_fondation }}</span>{% endif %}
            <input type="submit" class="btn" value="Enregistrer">
        </form>
    </div>
{{ include('layouts/footer.php') }}
