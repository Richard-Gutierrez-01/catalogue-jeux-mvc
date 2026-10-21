{{ include('layouts/header.php', {title: 'Nouveau jeu'}) }}
    <div class="container">
        <form method="post">
            <h2>Nouveau jeu</h2>
            <label>Nom
                <input type="text" name="nom" value="{{ jeu.nom }}">
            </label>
            {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}
            <label>Description
                <input type="text" name="description" value="{{ jeu.description }}">
            </label>
            {% if errors.description is defined %}<span class="error">{{ errors.description }}</span>{% endif %}
            <label>Genre
                <input type="text" name="genre" value="{{ jeu.genre }}">
            </label>
            {% if errors.genre is defined %}<span class="error">{{ errors.genre }}</span>{% endif %}
            <label>Note (sur 10)
                <input type="number" step="0.1" min="0" max="10" name="note" value="{{ jeu.note }}">
            </label>
            {% if errors.note is defined %}<span class="error">{{ errors.note }}</span>{% endif %}
            <label>Date de sortie
                <input type="date" name="date_sortie" value="{{ jeu.date_sortie }}">
            </label>
            {% if errors.date_sortie is defined %}<span class="error">{{ errors.date_sortie }}</span>{% endif %}
            <label>Développeur
                <select name="developpeur_id">
                    <option value="">— Aucun —</option>
                    {% for d in developpeurs %}
                    <option value="{{ d.id }}" {% if d.id == jeu.developpeur_id %}selected{% endif %}>{{ d.nom }}</option>
                    {% endfor %}
                </select>
            </label>
            {% if errors.developpeur_id is defined %}<span class="error">{{ errors.developpeur_id }}</span>{% endif %}
            <input type="submit" class="btn" value="Enregistrer">
        </form>
    </div>
{{ include('layouts/footer.php') }}
