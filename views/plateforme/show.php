{{ include('layouts/header.php', {title: plateforme.nom}) }}
    <div class="container">
        <h1>{{ plateforme.nom }}</h1>
        <p><strong>Description : </strong>{{ plateforme.description }}</p>
        <p><strong>Fabricant : </strong>{{ plateforme.fabricant }}</p>
        <p><strong>Date de lancement : </strong>{{ plateforme.date_lancement }}</p>

        <h3>Jeux disponibles</h3>
        {% if jeux|length > 0 %}
            <ul>
                {% for jeu in jeux %}
                    <li><a href="{{ base }}/jeu/show?id={{ jeu.id }}">{{ jeu.nom }}</a></li>
                {% endfor %}
            </ul>
        {% else %}
            <p>Aucun jeu associé pour l'instant.</p>
        {% endif %}

        <a href="{{ base }}/plateforme/edit?id={{ plateforme.id }}" class="btn">Modifier</a>
        <form action="{{ base }}/plateforme/delete" method="post" style="display:inline" onsubmit="return confirm('Supprimer cette plateforme ?');">
            <input type="hidden" name="id" value="{{ plateforme.id }}">
            <input type="submit" value="Supprimer" class="btn red">
        </form>
    </div>
{{ include('layouts/footer.php') }}
