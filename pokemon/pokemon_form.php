<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire d'insertion d'un pokemon</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
 <?php
// Entête HTML ce require permet de charger toutes les balises d'en-tête de la page HTML
require('header.php');
// Gestion de la base de donnée : paramètres et fonctions de bases
require('../inc/database.php');
$errors = [];
$form_errors = [];
// Connexion à la base
if (!$db = connexion($msg))
  echo "Erreur : " . implode($msg);
if (!isset($_GET['id']))
  die("Veuillez préciser un id de pokémon !");
$id = $_GET['id'];
$mode_edit = (isset($_GET['edit']) ? $_GET['edit'] : 0) == 1;
$query = $db->prepare("
  SELECT numero, nom, experience, vie, defense, attaque, nom_proprietaire
    FROM pokemon
      LEFT JOIN pokedex on (id_pokedex = pokedex.id)
    WHERE pokemon.id=:id
");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
if (!$result = $query->fetch())
  die("Pokémon id $id inconnu !");
$title = ($mode_edit ? "Modification" : "Consultation") . " du pokemon $id";
$image = "../img/pokeball.png";
?>

<div class="container">
  <h1 class="text-center"><?php echo $title ?></h1>
  <div class="row align-items-center">
    <div class="col-sm-4 d-none d-sm-block">
      <img class="img-fluid mx-auto" src="<?php echo $image;?>" alt="" />
    </div> <!-- col -->
    <div class="col-xs-12 col-sm-8">
      <form method="post" id="updatePokemon" enctype="multipart/form-data">
        <input type="hidden" name="updatePokemon" value="1"/>
        <div class="form-control">
          <div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="numero">Numéro</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['numero']) ? 'is-invalid' : '' ?>"
                  id="numero"
                  name="numero"
                  value="<?php echo isset($result['numero']) ? $result['numero'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['numero']) ? '<div class="invalid-feedback">' . $form_errors['numero'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="nom">Nom</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['nom']) ? 'is-invalid' : '' ?>"
                  id="nom"
                  name="nom"
                  value="<?php echo isset($result['nom']) ? $result['nom'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['nom']) ? '<div class="invalid-feedback">' . $form_errors['nom'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="experience">Expérience</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['experience']) ? 'is-invalid' : '' ?>"
                  id="experience"
                  name="experience"
                  value="<?php echo isset($result['experience']) ? $result['experience'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['experience']) ? '<div class="invalid-feedback">' . $form_errors['experience'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="vie">Vie</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['vie']) ? 'is-invalid' : '' ?>"
                  id="vie"
                  name="vie"
                  value="<?php echo isset($result['vie']) ? $result['vie'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['vie']) ? '<div class="invalid-feedback">' . $form_errors['vie'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="defense">Défense</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['defense']) ? 'is-invalid' : '' ?>"
                  id="defense"
                  name="defense"
                  value="<?php echo isset($result['defense']) ? $result['defense'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['defense']) ? '<div class="invalid-feedback">' . $form_errors['defense'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="attaque">Attaque</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control <?php echo isset($form_errors['attaque']) ? 'is-invalid' : '' ?>"
                  id="attaque"
                  name="attaque"
                  value="<?php echo isset($result['attaque']) ? $result['attaque'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                <?php echo isset($form_errors['attaque']) ? '<div class="invalid-feedback">' . $form_errors['attaque'] . '</div>' : '' ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="pokedex">Propriétaire</label>
              <div class="col-sm-9">
                <?php if ($mode_edit) : ?>
                <select
                  class="form-control <?php echo isset($form_errors['pokedex']) ? 'is-invalid' : '' ?>"
                  id="pokedex"
                  name="pokedex"
                  value="<?php echo isset($result['pokedex']) ? $result['pokedex'] : '' ?>"
                  <?php echo $mode_edit ? '' : 'readonly' ?>
                >
                  <option value="">- Aucun -</option>
                  <?php echo $pokedex_options; ?>
                </select>
                <?php echo isset($form_errors['pokedex']) ? '<div class="invalid-feedback">' . $form_errors['pokedex'] . '</div>' : '' ?>
                <?php else : ?>
                <input
                  type="text"
                  class="form-control"
                  id="attaque"
                  name="attaque"
                  value="<?php echo isset($result['nom_proprietaire']) ? $result['nom_proprietaire'] : '' ?>"
                  readonly
                >
                <?php endif; ?>
              </div>
            </div>
            <?php if ($mode_edit) : ?>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="image">Nouvelle image</label>
              <div class="col-sm-9">
              <input type="file" id="image" name="image" accept="image/*"/>
            </div>
            <?php endif; ?>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Valider</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </div>
      </form>
    </div><!-- col -->
  </div> <!-- row -->
</div> <!-- container -->

<?php
// Fin du HTML
require('footer.php');

  <div class="text-center">
    <img src="img/pokemon.png" alt="" style="width: 30%;">
  </div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-4 d-none d-sm-block">
        <img class="img-fluid mx-auto" src="img/mewtwo_in_masterball.png" alt="" />
      </div> <!-- Col -->
      <div class="col-xs-12 col-sm-8">
        <form method="post" id="insertPokemon">
          <input type="hidden" name="insertPokemon" value="1"/>
          <div class="form-control">
            <div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="numero_pokemon">Numéro</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['numero_pokemon']) ? 'is-invalid' : '' ?>" id="numero_pokemon" name="numero_pokemon" value="<?php echo isset($_POST['numero_pokemon']) ? $_POST['numero_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['numero_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['numero_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="nom_pokemon">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['nom_pokemon']) ? 'is-invalid' : '' ?>" id="nom_pokemon" name="nom_pokemon" value="<?php echo isset($_POST['nom_pokemon']) ? $_POST['nom_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['nom_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['nom_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="experience_pokemon">Expérience</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['experience_pokemon']) ? 'is-invalid' : '' ?>" id="experience_pokemon" name="experience_pokemon" value="<?php echo isset($_POST['experience_pokemon']) ? $_POST['experience_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['experience_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['experience_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="vie_pokemon">Vie</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['vie_pokemon']) ? 'is-invalid' : '' ?>" id="vie_pokemon" name="vie_pokemon" value="<?php echo isset($_POST['vie_pokemon']) ? $_POST['vie_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['vie_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['vie_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="defense_pokemon">Défense</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['defense_pokemon']) ? 'is-invalid' : '' ?>" id="defense_pokemon" name="defense_pokemon" value="<?php echo isset($_POST['defense_pokemon']) ? $_POST['defense_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['defense_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['defense_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="attaque_pokemon">Attaque</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control <?php echo isset($form_errors['attaque_pokemon']) ? 'is-invalid' : '' ?>" id="attaque_pokemon" name="attaque_pokemon" value="<?php echo isset($_POST['attaque_pokemon']) ? $_POST['attaque_pokemon'] : '' ?>">
                  <?php echo isset($form_errors['attaque_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['attaque_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="pokedex_pokemon">Propriétaire</label>
                <div class="col-sm-10">
                  <select class="form-control <?php echo isset($form_errors['pokedex_pokemon']) ? 'is-invalid' : '' ?>" id="pokedex_pokemon" name="pokedex_pokemon" value="<?php echo isset($_POST['pokedex_pokemon']) ? $_POST['pokedex_pokemon'] : '' ?>">
                    <option value="">- Aucun -</option>
                    <?php echo $pokedex_options; ?>
                  </select>
                  <?php echo isset($form_errors['pokedex_pokemon']) ? '<div class="invalid-feedback">' . $form_errors['pokedex_pokemon'] . '</div>' : '' ?>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </div>
        </form>
      </div><!-- Col -->
    </div> <!-- Row -->

    <div class="text-center">
      <?php
        if (count($errors) > 0)
          echo "<p>" . implode("</p><p>", $errors) . "</p>";
        else
          echo "$table";
      ?>
    </div>
  </div> <!-- Container -->

  <form method="post" id="deletePokemon">
    <input type="hidden" name="deletePokemon" value="1"/>
    <input type="hidden" id="id_delete" name="id_delete" value=""/>
  </form>

  <script src="function.js"></script>
</body>

</html>