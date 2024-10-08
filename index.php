<?php

declare(strict_types=1);

use App\Controller\LivreController;
use \Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

require __DIR__ . '/app/lib/init.php';
require __DIR__ . '/app/lib/functions.php'; 
?>

<?php
$livreController = new LivreController;
try {
    if (empty($_GET['page'])) {
        require 'app/Views/accueil.php';
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case 'livres':
                if(empty($url[1])){
                    $livreController->afficherLivres();
                } else if ($url[1] === 'l'){
                    $livreController->afficherUnLivre((int)$url[2]);
                } else if ($url[1] === 'a'){
                    echo "ajout un livre";
                } else if ($url[1] === 'm'){
                    echo "modification d'un livre";
                } else if ($url[1] === 's'){
                    echo "suppression d'un livre";
                } else {
                    throw new Exception("La page n'éxiste pas");
                }
                break;
            default:
            throw new Exception("La page n'éxiste pas");
            break;
        }
    }
} catch (Exception $e) {
    require '../app/views/error404.php';
}
