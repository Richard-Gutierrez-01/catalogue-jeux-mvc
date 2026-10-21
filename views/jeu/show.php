{{ include('layouts/header.php', {title: jeu.nom}) }}
    <div class="container">
        <h1>{{ jeu.nom }}</h1>
        <p><strong>Description : </strong>{{ jeu.description }}</p>
        <p><strong>Genre : </strong>{{ jeu.genre }}</p>
        <p><strong>Note : </strong>{{ jeu.note }}</p>
        <p><strong>Date de sortie : </strong>{{ jeu.date_sortie }}</p>
        <p><strong>Développeur : </strong>
            {% if developpeurNom %}
                <a href="{{ base }}/developpeur/show?id={{ jeu.developpeur_id }}">{{ developpeurNom }}</a>
            {% else %}—{% endif %}
        </p>

        <h3>Disponible sur</h3>
        {% if plateformes|length > 0 %}
            <ul>
                {% for plateforme in plateformes %}
                    <li><a href="{{ base }}/plateforme/show?id={{ plateforme.id }}">{{ plateforme.nom }}</a></li>
                {% endfor %}
            </ul>
        {% else %}
            <p>Aucune plateforme associée pour l'instant.</p>
        {% endif %}

        <a href="{{ base }}/jeu/edit?id={{ jeu.id }}" class="btn">Modifier</a>
        <form action="{{ base }}/jeu/delete" method="post" style="display:inline" onsubmit="return confirm('Supprimer ce jeu ?');">
            <input type="hidden" name="id" value="{{ jeu.id }}">
            <input type="submit" value="Supprimer" class="btn red">
        </form>
    </div>
{{ include('layouts/footer.php') }}
