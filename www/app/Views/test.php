<?php ob_start() ?>

Mon contenu

<?php
$titre = "Le test";
$content = ob_get_clean();
require_once 'template.php';
