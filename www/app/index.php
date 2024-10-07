<?php require_once './vendor/autoload.php' ?>
<?php require './lib/init.php' ?>
<?php require './lib/functions.php' ?>

<?php
try {
    // debug($_GET, $mode = 0);
    if (empty($_GET['page'])) {
        require 'Views/accueil.php';
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case 'livres':
                require 'Views/livres.php';
                break;
            case 'test':
                require 'Views/test.php';
                break;
        }
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
