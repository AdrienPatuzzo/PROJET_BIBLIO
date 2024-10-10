<?php ob_start() ?>

<?php if (isset($_SESSION['erreurs'])){
    foreach ($_SESSION['erreurs'] as $erreursTab) {
        foreach ($erreursTab as $erreurs){
            $divErreur = "<div class='alert alert-danger w-100 m-auto' style='max-width:781px'><ul>";
            foreach ($erreurs as $erreur) {
                $divErreur .= "<li>$erreur</li>";
            }
            $divErreur .= '</ul></div>';
            unset($_SESSION['erreurs']);
            echo $divErreur;
        }
    }
} ?>

<form method="POST" action="<?= SITE_URL ?>livres/av" enctype="multipart/form-data">
    <div class="form-group my-4">
        <label for="titre">Titre : </label>
        <input class="form-control" type="text" id="titre" name="titre">
    </div>
    <div class="form-group my-4">
        <label for="nbre-de-pages">Nombre de pages : </label>
        <input class="form-control" type="number" id="nbre-de-pages" name="nbre-de-pages">
    </div>
    <div class="form-group my-4">
        <label for="text-alternatif">Texte alternatif : </label>
        <textarea class="form-control" id="text-alternatif" name="text-alternatif"></textarea>
    </div>
    <img src="" id="image-preview" alt="">
    <div class="form-group my-4">
        <label for="image">Image : </label>
        <input class="form-control-file" type="file" id="image" name="image">
    </div>
    <button class="btn btn-info">Créer livre</button>
</form>

<?php
$titre = "ajout livre";
$content = ob_get_clean();
require_once 'template.php';
