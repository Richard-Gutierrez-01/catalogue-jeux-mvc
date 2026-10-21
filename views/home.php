{{ include('layouts/header.php', {title: 'Accueil'}) }}
    <section class="hero">
        <img src="{{ asset }}/img/hero.jpg" alt="" class="hero-image">

        <div class="hero-content">
            <p class="hero-eyebrow">CATALOGUE DE JEUX</p>

            <h1>Explorer le catalogue:</h1>

            <p>
                Un système de gestion simple pour suivre tes jeux,
                leurs développeurs et les plateformes sur lesquelles
                ils sont disponibles.
            </p>
        </div>
    </section>
    <a href="{{ base }}/jeu" class="btn hero-button">Voir les jeux</a>

    <section class="home-features">
        <a href="{{ base }}/jeu" class="feature">
            <img src="{{ asset }}/img/Asset-3.svg" alt="" class="feature-icon">
            <h3>Jeux</h3>
            <p>Découvrez notre catalogue.</p>
        </a>

        <a href="{{ base }}/developpeur" class="feature">
            <img src="{{ asset }}/img/Asset-2.svg" alt="" class="feature-icon">
            <h3>Développeurs</h3>
            <p>Explorez les développeurs.</p>
        </a>

        <a href="{{ base }}/plateforme" class="feature">
            <img src="{{ asset }}/img/Asset-1.svg" alt="" class="feature-icon">
            <h3>Plateformes</h3>
            <p>Consultez les plateformes disponibles.</p>
        </a>
    </section>
{{ include('layouts/footer.php') }}
