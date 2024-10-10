<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use App\Repository\livresRepository;

class LivreController{
    private $repositoryLivres;

    public function __construct(){
        $this->repositoryLivres = new livresRepository;
        $this->repositoryLivres->chargementLivresBdd();
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
        $image = $_FILES['image'];
        $repertoire = "images/";
        $nomImage = $this->ajoutImage($image, $repertoire);
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
            $imageActuelle = $this->ajoutImage($imageUpload, "images/");
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

    public function ajoutImage($image, $repertoire){
        if ($image['size'] === 0) {
            throw new Exception('Vous devez uploader une image');
        }

        if(!file_exists($repertoire)) mkdir($repertoire, 0777);

        $filename = uniqid() . "-" . $image['name'];
        $target = $repertoire . $filename;

        if (!getimagesize($image['tmp_name']))
            throw new Exception('Vous devez uploader une image');

        $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $extensionsTab = ['png', 'webp', 'jpeg'];

        if (!in_array($extension, $extensionsTab))
            throw new Exception("Extension non autorisée => ['png', 'webp', 'jpg']");

        if ($image['size'] > 4000000) // 4MO
            throw new Exception("Fichier trop volumineux : max 4MO");

        if (!move_uploaded_file($image['tmp_name'], $target))
            throw new Exception("Le transfert de l'image à échoué");
        else
            return $filename;
    }
}
