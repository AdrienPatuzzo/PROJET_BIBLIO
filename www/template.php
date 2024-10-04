<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
  <title>Biblio | Accueil</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/template.php">Biblio</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Basculer la navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="/">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Home
                </font>
              </font><span class="visually-hidden">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">(actuel)</font>
                </font>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/livres.php">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Livres</font>
              </font>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php echo $content ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>