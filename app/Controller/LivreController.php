<?php

declare(strict_types=1);

namespace App\Controller;


use App\Service\Utils;
use App\Repository\LivresRepository;
use App\Service\ValidationDonnees;

class LivreController{
    private LivresRepository $repositoryLivres;
    private ValidationDonnees $validationDonnees;

    public function __construct(){
        $this->repositoryLivres = new LivresRepository;
        $this->repositoryLivres->chargementLivresBdd();
        $this->validationDonnees = new ValidationDonnees();
    }

    public function afficherLivres(){
        $livresTab = $this->repositoryLivres->getLivres();
        $pasDeLivre = (count($livresTab) > 0) ? false : true;
        require "../app/views/livres.php";
    }

    public function afficherUnLivre($idLivre){
        $livre = $this->repositoryLivres->getLivreById($idLivre);
        ($livre !== null) ? require "../app/views/afficherlivre.php" : require "../app/Views/error404.php";
    }

    public function ajouterLivre(){
        require '../app/views/ajouterLivre.php';
    }

    public function validationAjoutLivre(){
        $erreurs = $this->validationDonnees->valider(['titre' => ['required', 'match:/^[A-Z][A-Za-z\- ]+$/']], $_POST);
        
        if (is_array($erreurs) && count($erreurs) > 0) {
            $_SESSION['erreurs'][] = $erreurs;
            header('location: ' . SITE_URL . 'livres/a');
            exit;
        }
        $image = $_FILES['image'];
        $repertoire = "images/";
        $nomImage = Utils::ajoutImage($image, $repertoire);
        $this->repositoryLivres->ajouterLivreBdd($_POST['titre'], (int)$_POST['nbre-de-pages'], $nomImage, $_POST['text-alternatif']);
        header('location: ' . SITE_URL . 'livres');
    }

    public function modifierLivre($idLivre) {
        $livre = $this->repositoryLivres->getLivreById($idLivre);
        require '../app/views/modifierLivre.php';
    }

    public function validationModifierLivre () {
        $idLivre = (int)$_POST['id_livre'];
        $imageActuelle = $this->repositoryLivres->getLivreById($idLivre)->getUrlImage();
        $imageUpload = $_FILES['image'];
        $cheminImage = "image/$imageActuelle";
        if($imageUpload['size'] > 0){
            if (file_exists($cheminImage)) {
                unlink("images/$cheminImage");
            }
            $imageActuelle = Utils::ajoutImage($imageUpload, "images/");
        }
        $this->repositoryLivres->modificationLivreBdd($_POST['titre'], (int)$_POST['nbre-de-pages'], $imageActuelle, $_POST['text-alternatif'], $idLivre);
        header('location: ' . SITE_URL . 'livres');
    }

    public function supprimerLivre($idLivre) {
        $nomImage = $this->repositoryLivres->getLivreById($idLivre)->getUrlImage();
        $filename = "images/$nomImage";
        if (file_exists($filename)) unlink($filename);
        $this->repositoryLivres->supprimerLivreBdd($idLivre);
        header('location: ' . SITE_URL . 'livres');
    }
}
