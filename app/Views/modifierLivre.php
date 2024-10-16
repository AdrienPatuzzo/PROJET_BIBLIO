<?php ob_start() ?>

<?php require '../app/Views/showErreurs.php'; ?>

<form method="POST" action="<?= SITE_URL ?>livres/mv" enctype="multipart/form-data">
    <div class="form-group my-4">
        <label for="titre">Titre : </label>
        <input class="form-control" type="text" value="<?= $livre->getTitre(); ?>" id="titre" name="titre">
    </div>
    <div class="form-group my-4">
        <label for="nbre-de-pages">Nombre de pages : </label>
        <input class="form-control" type="number" value="<?= $livre->getNbreDePages(); ?>" id="nbre-de-pages" name="nbre-de-pages">
    </div>
    <div class="form-group my-4">
        <label for="text-alternatif">Texte alternatif : </label>
        <textarea class="form-control" id="text-alternatif" name="text-alternatif"><?= $livre->getTextAlternatif(); ?></textarea>
    </div>
    <img id="image-preview" src="<?= SITE_URL ?>images/<?= $livre->getUrlImage(); ?>" alt="<?= $livre->getTextAlternatif(); ?>">
    <div class="form-group my-4">
        <label for="image">Image : </label>
        <input class="form-control-file" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="id_livre" value="<?= $livre->getId(); ?>">
    <?= $csrfToken ?>
    <button class="btn btn-info">Modifier livre</button>
</form>

<?php
$titre = "modifier le livre " . $livre->getTitre();
$content = ob_get_clean();
require_once 'template.php';
