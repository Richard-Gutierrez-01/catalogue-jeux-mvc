{{ include('layouts/header.php', {title: 'Modifier la plateforme'}) }}
    <div class="container">
        <form method="post">
            <h2>Modifier la plateforme</h2>
            <label>Nom
                <input type="text" name="nom" value="{{ plateforme.nom }}">
            </label>
            {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}
            <label>Description
                <input type="text" name="description" value="{{ plateforme.description }}">
            </label>
            {% if errors.description is defined %}<span class="error">{{ errors.description }}</span>{% endif %}
            <label>Fabricant
                <input type="text" name="fabricant" value="{{ plateforme.fabricant }}">
            </label>
            {% if errors.fabricant is defined %}<span class="error">{{ errors.fabricant }}</span>{% endif %}
            <label>Date de lancement
                <input type="date" name="date_lancement" value="{{ plateforme.date_lancement }}">
            </label>
            {% if errors.date_lancement is defined %}<span class="error">{{ errors.date_lancement }}</span>{% endif %}
            <input type="submit" class="btn" value="Enregistrer">
        </form>
    </div>
{{ include('layouts/footer.php') }}
