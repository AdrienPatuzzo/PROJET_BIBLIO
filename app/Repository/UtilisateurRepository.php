<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Models\Utilisateur;
use App\Service\AbstractConnexion;

class UtilisateurRepository extends AbstractConnexion
{
    private Utilisateur $utilisateur;

    public function getUtilisateurByEmail(string $email){
        $req = "SELECT * FROM utilisateur WHERE adresse_mail = ?";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->execute([$email]);
        $utilisateurTab = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if (!$utilisateurTab){
            return false;
        } else {
            $utilisateur = new Utilisateur(
            $utilisateurTab['id_utilisateur'], 
            $utilisateurTab['identifiant'],
            $utilisateurTab['password'], 
            $utilisateurTab['adresse_mail'], 
            $utilisateurTab['role']);
            $this->setUtilisateur($utilisateur);
            return $this->getUtilisateur();
        }
    }

    /**
     * Get the value of utilisateur
     *
     * @return Utilisateur
     */
    public function getUtilisateur(): Utilisateur {
        return $this->utilisateur;
    }

    /**
     * Set the value of utilisateur
     *
     * @param Utilisateur $utilisateur
     *
     * @return self
     */
    public function setUtilisateur(Utilisateur $utilisateur): self {
        $this->utilisateur = $utilisateur;
        return $this;
    }
}
