<?php
require "vendor/autoload.php";
use Doctrine\Common\Collections\ArrayCollection;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Php Avancé</title>
    <?php
    include "./src/includes/headCalls.php";
    ?>
</head>
<body>
<header>
    <h1>POO : Programmation Orientée Objet</h1>
</header>
<nav>
    <?php
    include "./src/includes/navigation.php";
    ?>
</nav>
<main class="container">
    <section class="row">
        <article class="col-lg-8 offset-2">
            <h1>Modification d'un jeu : </h1>
            <form method="post">
                <!--
                [ID] => 1
                [nom] => Super Mario Bros
                [possesseur] => Florent
                [console] => NES
                [prix] => 4
                [nbre_joueurs_max] => 1
                [commentaires] => Un jeu d'anthologie !
                -->
                <fieldset class="form-group">
                    <label for="nom">nom jeu</label>
                    <input type="text" name="nom" id="nom" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="possesseur">possesseur</label>
                    <input type="text" name="possesseur" id="possesseur" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="console">console</label>
                    <input type="text" name="console" id="console" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="prix">prix</label>
                    <input type="text" name="prix" id="prix" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="nbJmax">nbJmax</label>
                    <input type="text" name="nbJmax" id="nbJmax" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="commentaires">Commentaires</label><br />
                    <textarea name="commentaires" id="commentaires"></textarea>
                </fieldset>
                <button class="btn btn-primary" type="submit" name="modifJeu" id="modifJeu" value="modifJeu">
                    Modifier le jeu
                </button>
            </form>
        </article>
    </section>
</main>
<footer>
    &copy;Dawan
</footer>
</body>
</html>
