<?php ob_start() ?>

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
