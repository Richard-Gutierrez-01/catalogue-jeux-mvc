<?php
namespace App\Controllers;

use App\Models\Jeu;
use App\Models\Developpeur;
use App\Providers\View;
use App\Providers\Validator;

// Contrôleur Jeu : CRUD complet (index, show, create, store, edit, update, delete)
class JeuController {

    public function index(){
        $jeu = new Jeu;
        $jeux = $jeu->selectAvecDeveloppeur();
        if($jeux){
            return View::render('jeu/index', ['jeux' => $jeux]);
        }else{
            return View::render('error', ['msg' => 'Aucun jeu trouvé']);
        }
    }

    public function show($data = []){
        if(isset($data['id'])){
            $id = $data['id'];
            $jeu = new Jeu;
            $jeuInfo = $jeu->selectId($id);
            if($jeuInfo){
                $developpeurNom = null;
                if(!empty($jeuInfo['developpeur_id'])){
                    $developpeur = new Developpeur;
                    $dev = $developpeur->selectId($jeuInfo['developpeur_id']);
                    $developpeurNom = $dev ? $dev['nom'] : null;
                }
                $plateformes = $jeu->plateformes($id);
                return View::render('jeu/show', [
                    'jeu' => $jeuInfo,
                    'developpeurNom' => $developpeurNom,
                    'plateformes' => $plateformes
                ]);
            }else{
                return View::render('error', ['msg' => 'Jeu introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function create(){
        $developpeur = new Developpeur;
        $developpeurs = $developpeur->select('nom');
        return View::render('jeu/create', ['developpeurs' => $developpeurs]);
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->min(2)->max(100);
        $val->field('description', $data['description'] ?? '')->max(1000);
        $val->field('genre', $data['genre'] ?? '')->max(50);
        $val->field('note', $data['note'] ?? '')->float();
        $val->field('date_sortie', $data['date_sortie'] ?? '')->max(10);
        $val->field('developpeur_id', $data['developpeur_id'] ?? '', 'Développeur')->int();

        if($val->isSuccess()){
            $data['date_ajout'] = date('Y-m-d');
            foreach(['developpeur_id', 'date_sortie', 'note'] as $champ){
                if(!isset($data[$champ]) || $data[$champ] === ''){
                    $data[$champ] = null;
                }
            }
            $jeu = new Jeu;
            $insert = $jeu->insert($data);
            if($insert){
                return View::redirect('jeu/show?id='.$insert);
            }else{
                return View::render('error', ['msg' => "Erreur lors de l'ajout du jeu"]);
            }
        }else{
            $errors = $val->getErrors();
            $developpeur = new Developpeur;
            $developpeurs = $developpeur->select('nom');
            return View::render('jeu/create', ['errors' => $errors, 'jeu' => $data, 'developpeurs' => $developpeurs]);
        }
    }

    public function edit($data = []){
        if(isset($data['id'])){
            $id = $data['id'];
            $jeu = new Jeu;
            $jeuInfo = $jeu->selectId($id);
            if($jeuInfo){
                $developpeur = new Developpeur;
                $developpeurs = $developpeur->select('nom');
                return View::render('jeu/edit', ['jeu' => $jeuInfo, 'developpeurs' => $developpeurs]);
            }else{
                return View::render('error', ['msg' => 'Jeu introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function update(array $data, $get = []){
        if(!empty($get['id'])){
            $val = new Validator;
            $val->field('nom', $data['nom'])->required()->min(2)->max(100);
            $val->field('description', $data['description'] ?? '')->max(1000);
            $val->field('genre', $data['genre'] ?? '')->max(50);
            $val->field('note', $data['note'] ?? '')->float();
            $val->field('date_sortie', $data['date_sortie'] ?? '')->max(10);
            $val->field('developpeur_id', $data['developpeur_id'] ?? '', 'Développeur')->int();

            if($val->isSuccess()){
                foreach(['developpeur_id', 'date_sortie', 'note'] as $champ){
                    if(!isset($data[$champ]) || $data[$champ] === ''){
                        $data[$champ] = null;
                    }
                }
                $jeu = new Jeu;
                $updated = $jeu->update($data, $get['id']);
                if($updated){
                    return View::redirect('jeu/show?id='.$get['id']);
                }else{
                    return View::render('error', ['msg' => 'Erreur lors de la modification du jeu']);
                }
            }else{
                $errors = $val->getErrors();
                $data['id'] = $get['id'];
                $developpeur = new Developpeur;
                $developpeurs = $developpeur->select('nom');
                return View::render('jeu/edit', ['errors' => $errors, 'jeu' => $data, 'developpeurs' => $developpeurs]);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function delete($data){
        if(!empty($data['id'])){
            $jeu = new Jeu;
            $deleted = $jeu->deleteJeu($data['id']);
            if($deleted){
                return View::redirect('jeu');
            }else{
                return View::render('error', ['msg' => 'Erreur lors de la suppression du jeu']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }
}

?>
