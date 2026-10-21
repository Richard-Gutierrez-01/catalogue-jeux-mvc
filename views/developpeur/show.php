{{ include('layouts/header.php', {title: developpeur.nom}) }}
    <div class="container">
        <h1>{{ developpeur.nom }}</h1>
        <p><strong>Pays d'origine : </strong>{{ developpeur.pays_origine }}</p>
        <p><strong>Date de fondation : </strong>{{ developpeur.date_fondation }}</p>

        <h3>Jeux</h3>
        {% if jeux|length > 0 %}
            <ul>
                {% for jeu in jeux %}
                    <li><a href="{{ base }}/jeu/show?id={{ jeu.id }}">{{ jeu.nom }}</a></li>
                {% endfor %}
            </ul>
        {% else %}
            <p>Aucun jeu associé pour l'instant.</p>
        {% endif %}

        <a href="{{ base }}/developpeur/edit?id={{ developpeur.id }}" class="btn">Modifier</a>
        <form action="{{ base }}/developpeur/delete" method="post" style="display:inline" onsubmit="return confirm('Supprimer ce développeur ?');">
            <input type="hidden" name="id" value="{{ developpeur.id }}">
            <input type="submit" value="Supprimer" class="btn red">
        </form>
    </div>
{{ include('layouts/footer.php') }}
