<?php
namespace App\Models;
use App\Models\CRUD;

// Modèle Plateforme : CRUD complet + relation N-N avec Jeu
class Plateforme extends CRUD {
    protected $table = 'plateforme';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description', 'date_ajout', 'fabricant', 'date_lancement'];

    // Tous les jeux disponibles sur cette plateforme (relation N-N via jeu_plateforme)
    public function jeux($plateformeId){
        $sql = "SELECT jeu.*, jeu_plateforme.date_sortie_plateforme
                FROM jeu
                INNER JOIN jeu_plateforme ON jeu_plateforme.jeu_id = jeu.id
                WHERE jeu_plateforme.plateforme_id = :plateforme_id
                ORDER BY jeu.nom ASC";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':plateforme_id', $plateformeId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Suppression manuelle en cascade : on retire d'abord les liens jeu_plateforme,
    // puis la plateforme (même convention que Jeu::deleteJeu()).
    public function deletePlateforme($id){
        $sql = "DELETE FROM jeu_plateforme WHERE plateforme_id = :plateforme_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':plateforme_id', $id);
        $stmt->execute();

        return $this->delete($id);
    }
}

?>
