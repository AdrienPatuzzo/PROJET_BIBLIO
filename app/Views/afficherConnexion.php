<?php ob_start() ?>

<?php require '../app/Views/showErreurs.php'; ?>
<form method="POST" action="<?= SITE_URL ?>login/v">
  <fieldset>
    <div>
      <label for="email" class="form-label mt-4">addresse email</label>
      <input type="email" autofocus class="form-control" id="adresse_mail" aria-describedby="emailHelp" name="email" placeholder="Entrer votre adresse email">
      <small id="emailHelp" class="form-text text-muted">Ne donner jamais votre email ou votre mot de passe à n'importe qui.</small>
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Mot de passe</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" autocomplete="off">
    </div>
    <?= $csrfToken ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
  </fieldset>
</form>

<?php
$titre = "Connexion";
$content = ob_get_clean();
require_once 'template.php';
