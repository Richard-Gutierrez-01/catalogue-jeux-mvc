{{ include('layouts/header.php', {title: 'Plateformes'}) }}
    <h1>Plateformes</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Fabricant</th>
                <th>Date de lancement</th>
                <th>Voir</th>
            </tr>
        </thead>
        <tbody>
            {% for p in plateformes %}
            <tr>
                <td><a href="{{ base }}/plateforme/show?id={{ p.id }}">{{ p.nom }}</a></td>
                <td>{{ p.fabricant }}</td>
                <td>{{ p.date_lancement }}</td>
                <td><a href="{{ base }}/plateforme/show?id={{ p.id }}" class="btn">Voir</a></td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/plateforme/create" class="btn table-button">Nouvelle plateforme</a>
{{ include('layouts/footer.php') }}
