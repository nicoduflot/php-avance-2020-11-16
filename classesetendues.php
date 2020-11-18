<?php
require "vendor/autoload.php";
use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
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
        <article class="col-lg-12">
            <h1>Classes Etendues</h1>
            <h2>Principes</h2>
            <pre>
                <?php
                $perso1 = new Mage("Froideval", new Arme("Epée", 2));
                $perso2 = new Personnage("Simean", new Arme("Lance", 1));
                //print_r($perso1);
                ?>
            </pre>
            <p>
                <?php
                $perso1->frapper($perso2);
                $perso2->frapper($perso1);
                $perso1->frapper($perso2);
                $perso2->frapper($perso1);
                $perso1->bouleDeFeu($perso2);
                ?>
            </p>
        </article>
    </section>
</main>
<footer>
    &copy;Dawan
</footer>
</body>
</html>
