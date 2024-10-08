<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\livresRepository;

class LivreController{
    private $repositoryLivres;

    public function __construct(){
        $this->repositoryLivres = new livresRepository;
        $this->repositoryLivres->chargementLivresBdd();
    }

    public function afficherLivres(){
        $livresTab = $this->repositoryLivres->getLivres();
        require "../app/views/livres.php";
    }

    public function afficherUnLivre($idLivre){
        $livre = $this->repositoryLivres->getLivreById($idLivre);
        ($livre !== null) ? require "../app/views/afficherlivre.php" : require "../app/Views/error404.php";
    }
}
