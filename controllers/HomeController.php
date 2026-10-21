<?php
namespace App\Controllers;

use App\Models\Jeu;
use App\Providers\View;

// Page d'accueil : affiche quelques statistiques simples du catalogue
class HomeController {

    public function index(){
        $jeu = new Jeu;
        $jeux = $jeu->select();
        $nombreJeux = count($jeux);

        View::render('home', ['nombreJeux' => $nombreJeux]);
    }
}

?>
