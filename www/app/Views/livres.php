<?php 
require 'Models/Livres/Livre.php';

$l1 = new Livre(1, "In My Head", 567, "/public/images/in-my-head.png", "Image de couverture du livre in my head");
$l2 = new Livre(2, "Le dev fou", 567, "/public/images/le_dev_fou.png", "Image de couverture du livre le dev fou");
$l3 = new Livre(3, "Mon futur site web", 567, "/public/images/mon-futur-site-web.png", "Image de couverture du livre mon futur site web");

$livres = [$l1, $l2, $l3];

?>

<?php ob_start() ?>

<table class="table test-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th clopsan="2">Actions</th>
    </tr>
    <tr>
        <td class="align-middle"><img src="../public/images/in-my-head.png" style="height: 60px;" alt="texte-alternatif";></td>
        <td class="align-middle">In my Head</td>
        <td class="align-middle">345</td>
        <td class="align-middle"><a href="#" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="#" class="btn btn-danger">Supprimer</a></td>
    </tr>
    <tr>
        <td class="align-middle"><img src="../public/images/le_dev_fou.png" style="height: 60px;" alt="texte-alternatif"></td>
        <td class="align-middle">Le Dev Fou</td>
        <td class="align-middle">3045</td>
        <td class="align-middle"><a href="#" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="#" class="btn btn-danger">Supprimer</a></td>
    </tr>
</table>
<a href="#" class="btn btn-success d-block w-100">Ajouter</a>

<?php
$titre = "Livres";
$content = ob_get_clean();
require_once 'template.php';