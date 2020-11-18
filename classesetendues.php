<?php
require "vendor/autoload.php";
use Gam\Personnage;
use Gam\Arme;
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
                $perso1 = new Personnage("Froideval", new Arme("Epée", 2));
                print_r($perso1);
                ?>
            </pre>
        </article>
    </section>
</main>
<footer>
    &copy;Dawan
</footer>
</body>
</html>
