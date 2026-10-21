<?php
namespace App\Controllers;

use App\Models\Developpeur;
use App\Providers\View;
use App\Providers\Validator;

// Contrôleur Developpeur : CRUD complet (index, show, create, store, edit, update, delete)
class DeveloppeurController {

    public function index(){
        $developpeur = new Developpeur;
        $developpeurs = $developpeur->select('nom');
        return View::render('developpeur/index', ['developpeurs' => $developpeurs]);
    }

    public function show($data = []){
        if(isset($data['id'])){
            $id = $data['id'];
            $developpeur = new Developpeur;
            $developpeurInfo = $developpeur->selectId($id);
            if($developpeurInfo){
                $jeux = $developpeur->jeux($id);
                return View::render('developpeur/show', ['developpeur' => $developpeurInfo, 'jeux' => $jeux]);
            }else{
                return View::render('error', ['msg' => 'Développeur introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function create(){
        return View::render('developpeur/create');
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('nom', $data['nom'] ?? '')->required()->min(2)->max(100);
        $val->field('pays_origine', $data['pays_origine'] ?? '', "pays d'origine")->max(100);
        $val->field('date_fondation', $data['date_fondation'] ?? '', 'date de fondation')->max(10);

        if($val->isSuccess()){
            if(empty($data['date_fondation'])){
                $data['date_fondation'] = null;
            }
            $developpeur = new Developpeur;
            $insert = $developpeur->insert($data);
            if($insert){
                return View::redirect('developpeur/show?id='.$insert);
            }else{
                return View::render('error', ['msg' => "Erreur lors de l'ajout du développeur"]);
            }
        }else{
            return View::render('developpeur/create', ['errors' => $val->getErrors(), 'developpeur' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id'])){
            $developpeur = new Developpeur;
            $developpeurInfo = $developpeur->selectId($data['id']);
            if($developpeurInfo){
                return View::render('developpeur/edit', ['developpeur' => $developpeurInfo]);
            }else{
                return View::render('error', ['msg' => 'Développeur introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function update(array $data, $get = []){
        if(!empty($get['id'])){
            $val = new Validator;
            $val->field('nom', $data['nom'] ?? '')->required()->min(2)->max(100);
            $val->field('pays_origine', $data['pays_origine'] ?? '', "pays d'origine")->max(100);
            $val->field('date_fondation', $data['date_fondation'] ?? '', 'date de fondation')->max(10);

            if($val->isSuccess()){
                if(empty($data['date_fondation'])){
                    $data['date_fondation'] = null;
                }
                $developpeur = new Developpeur;
                if($developpeur->update($data, $get['id'])){
                    return View::redirect('developpeur/show?id='.$get['id']);
                }else{
                    return View::render('error', ['msg' => 'Erreur lors de la modification du développeur']);
                }
            }else{
                $data['id'] = $get['id'];
                return View::render('developpeur/edit', ['errors' => $val->getErrors(), 'developpeur' => $data]);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function delete($data){
        if(!empty($data['id'])){
            $developpeur = new Developpeur;
            if($developpeur->deleteDeveloppeur($data['id'])){
                return View::redirect('developpeur');
            }else{
                return View::render('error', ['msg' => 'Suppression impossible : ce développeur a encore des jeux associés. Supprimez ou réassignez ses jeux d\'abord.']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }
}

?>
