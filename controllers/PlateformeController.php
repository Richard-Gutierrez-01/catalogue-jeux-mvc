<?php
namespace App\Controllers;

use App\Models\Plateforme;
use App\Providers\View;
use App\Providers\Validator;

// Contrôleur Plateforme : CRUD complet (index, show, create, store, edit, update, delete)
class PlateformeController {

    public function index(){
        $plateforme = new Plateforme;
        $plateformes = $plateforme->select('nom');
        return View::render('plateforme/index', ['plateformes' => $plateformes]);
    }

    public function show($data = []){
        if(isset($data['id'])){
            $id = $data['id'];
            $plateforme = new Plateforme;
            $plateformeInfo = $plateforme->selectId($id);
            if($plateformeInfo){
                $jeux = $plateforme->jeux($id);
                return View::render('plateforme/show', ['plateforme' => $plateformeInfo, 'jeux' => $jeux]);
            }else{
                return View::render('error', ['msg' => 'Plateforme introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function create(){
        return View::render('plateforme/create');
    }

    public function store(array $data){
        $val = new Validator;
        $val->field('nom', $data['nom'] ?? '')->required()->min(2)->max(100);
        $val->field('description', $data['description'] ?? '')->max(1000);
        $val->field('fabricant', $data['fabricant'] ?? '')->max(100);
        $val->field('date_lancement', $data['date_lancement'] ?? '', 'date de lancement')->max(10);

        if($val->isSuccess()){
            $data['date_ajout'] = date('Y-m-d');
            if(empty($data['date_lancement'])){
                $data['date_lancement'] = null;
            }
            $plateforme = new Plateforme;
            $insert = $plateforme->insert($data);
            if($insert){
                return View::redirect('plateforme/show?id='.$insert);
            }else{
                return View::render('error', ['msg' => "Erreur lors de l'ajout de la plateforme"]);
            }
        }else{
            return View::render('plateforme/create', ['errors' => $val->getErrors(), 'plateforme' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id'])){
            $plateforme = new Plateforme;
            $plateformeInfo = $plateforme->selectId($data['id']);
            if($plateformeInfo){
                return View::render('plateforme/edit', ['plateforme' => $plateformeInfo]);
            }else{
                return View::render('error', ['msg' => 'Plateforme introuvable']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function update(array $data, $get = []){
        if(!empty($get['id'])){
            $val = new Validator;
            $val->field('nom', $data['nom'] ?? '')->required()->min(2)->max(100);
            $val->field('description', $data['description'] ?? '')->max(1000);
            $val->field('fabricant', $data['fabricant'] ?? '')->max(100);
            $val->field('date_lancement', $data['date_lancement'] ?? '', 'date de lancement')->max(10);

            if($val->isSuccess()){
                if(empty($data['date_lancement'])){
                    $data['date_lancement'] = null;
                }
                $plateforme = new Plateforme;
                if($plateforme->update($data, $get['id'])){
                    return View::redirect('plateforme/show?id='.$get['id']);
                }else{
                    return View::render('error', ['msg' => 'Erreur lors de la modification de la plateforme']);
                }
            }else{
                $data['id'] = $get['id'];
                return View::render('plateforme/edit', ['errors' => $val->getErrors(), 'plateforme' => $data]);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }

    public function delete($data){
        if(!empty($data['id'])){
            $plateforme = new Plateforme;
            if($plateforme->deletePlateforme($data['id'])){
                return View::redirect('plateforme');
            }else{
                return View::render('error', ['msg' => 'Erreur lors de la suppression de la plateforme']);
            }
        }else{
            return View::render('error', ['msg' => 'Code 404 - Page introuvable']);
        }
    }
}

?>
