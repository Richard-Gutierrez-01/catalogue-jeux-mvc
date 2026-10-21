<?php
namespace App\Models;
use App\Models\CRUD;

// Modèle Jeu : entité principale, CRUD complet + relations avec Developpeur (1-N) et Plateforme (N-N)
class Jeu extends CRUD {
    protected $table = 'jeu';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description', 'date_ajout', 'genre', 'note', 'date_sortie', 'developpeur_id'];

    // Tous les jeux, avec le nom du développeur (LEFT JOIN : un jeu peut ne pas avoir de développeur)
    public function selectAvecDeveloppeur(){
        $sql = "SELECT jeu.*, developpeur.nom AS developpeur_nom
                FROM jeu
                LEFT JOIN developpeur ON developpeur.id = jeu.developpeur_id
                ORDER BY jeu.nom ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Les plateformes sur lesquelles ce jeu est disponible (relation N-N via jeu_plateforme)
    public function plateformes($jeuId){
        $sql = "SELECT plateforme.*, jeu_plateforme.date_sortie_plateforme
                FROM plateforme
                INNER JOIN jeu_plateforme ON jeu_plateforme.plateforme_id = plateforme.id
                WHERE jeu_plateforme.jeu_id = :jeu_id
                ORDER BY plateforme.nom ASC";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':jeu_id', $jeuId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Suppression manuelle en cascade : on retire d'abord les liens jeu_plateforme,
    // puis la ligne du jeu (delete() de CRUD est final et ne gère qu'une seule table).
    // Convention reprise du cours : pas de ON DELETE CASCADE au niveau SQL.
    public function deleteJeu($id){
        $sql = "DELETE FROM jeu_plateforme WHERE jeu_id = :jeu_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':jeu_id', $id);
        $stmt->execute();

        return $this->delete($id);
    }
}

?>
