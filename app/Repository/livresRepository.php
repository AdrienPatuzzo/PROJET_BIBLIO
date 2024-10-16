<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Models\Livre;
use App\Service\AbstractConnexion;

class LivresRepository extends AbstractConnexion
{
    /**
     * Tableau de livres
     *
     * @var array
     */
    private array $livres = [];

    public function ajouterLivre(object $nouveauLivre)
    {
        $this->livres[] =  $nouveauLivre;
    }

    public function chargementLivresBdd()
    {
        // protection injection SQL
        $req = $this->getConnexionBdd()->prepare("SELECT * FROM livre");
        $req->execute();
        $livresImportes = $req->fetchALL(PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach ($livresImportes as $livre) {
            $newLivre = new Livre($livre['id_livre'], $livre['titre'], $livre['nbre_de_pages'], $livre['url_image'], $livre['text_alternatif'], $livre['id_utilisateur']);
            $this->ajouterLivre($newLivre);
        }
        return $this->getLivres();
    }

    public function getLivreByIdUtilisateur($idUtilisateur)
    {
        $req = $this->getConnexionBdd()->prepare("SELECT * FROM livre WHERE id_utilisateur = ?");
        $req->execute([$idUtilisateur]);
        $livresImportes = $req->fetchALL(PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach ($livresImportes as $livre) {
            $newLivre = new Livre($livre['id_livre'], $livre['titre'], $livre['nbre_de_pages'], $livre['url_image'], $livre['text_alternatif'], $livre['id_utilisateur']);
            $this->ajouterLivre($newLivre);
        }
        return $this->getLivres();
    }

    public function getLivreById($idLivre)
    {
        $this->getLivres();
        foreach ($this->livres as $livre) {
            if ($livre->getId() === $idLivre) {
                return $livre;
            }
        }
    }

    public function ajouterLivreBdd(string $titre, int $nbreDePages, string $nomImage, string $textAlternatif)
    {
        // protection injection sql
        $idUtilisateur = $_SESSION['utilisateur']['id_utilisateur'];
        $req = "INSERT INTO livre (titre, nbre_de_pages, url_image, text_alternatif, id_utilisateur) VALUES (:titre, :nbre_de_pages, :url_image, :text_alternatif, :id_utilisateur)";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbre_de_pages", $nbreDePages, PDO::PARAM_INT);
        $stmt->bindValue(":url_image", $nomImage, PDO::PARAM_STR);
        $stmt->bindValue(":text_alternatif", $textAlternatif, PDO::PARAM_STR);
        $stmt->bindValue(":id_utilisateur", $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function modificationLivreBdd(string $titre, int $nbreDePages, string $nomImage, string $textAlternatif, int $idLivre)
    {
        $idUtilisateur = $_SESSION['utilisateur']['role'] !== 'ROLE_ADMIN' ? $_SESSION['utilisateur']['id_utilisateur'] : $this->getLivreById($idLivre)->getIdUtilisateur();
        $req = "UPDATE livre SET titre = :titre, nbre_de_pages = :nbre_de_pages,  url_image = :url_image, text_alternatif = :text_alternatif, id_utilisateur = :id_utilisateur WHERE id_livre = :id_livre";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->bindValue(":id_livre", $idLivre, PDO::PARAM_INT);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbre_de_pages", $nbreDePages, PDO::PARAM_INT);
        $stmt->bindValue(":url_image", $nomImage, PDO::PARAM_STR);
        $stmt->bindValue(":text_alternatif", $textAlternatif, PDO::PARAM_STR);
        $stmt->bindValue(":id_utilisateur", $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function supprimerLivreBdd($idLivre)
    {
        $req = "DELETE FROM livre WHERE id_livre = :id_livre";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->bindValue(":id_livre", $idLivre, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    /**
     * Get All livres
     *
     * @return array
     */
    public function getLivres(): array
    {
        return $this->livres;
    }

    /**
     * Get All livres
     *
     * @return array
     */
    public function setLivres(array $livres): self 
    {
        $this->livres = $livres;
        return $this;
    }
}
