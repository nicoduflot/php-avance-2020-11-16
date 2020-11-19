<?php
require "vendor/autoload.php";
use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;
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
            <p>
                Une est étendue quand elle possède une classe fille. La classe fille
                hérite automatiquement des attributs et des méthodes de la classe mère. L'avantage
                est que la classe fille peut posséder ses propres méthodes et attributs, mais elle peut aussi
                surcharger les méthodes de la classe mère en les redéfinissants. Mais si on veut pouvoir redéfinir,
                par exemple, les getters ou setters de la classe mère, les attributs concernés dans la classe
                mère doivent être alors déclarés en protected et plus en private.
            </p>
            <pre>
                <?php
                $perso1 = new Mage("Froideval", new Arme("Epée", 2));
                $perso2 = new Guerrier("Simean", new Arme("Lance", 1));
                print_r($perso2);
                ?>
            </pre>
            <p>
                <?php
                /*
                $perso1->frapper($perso2);
                $perso2->frapper($perso1);
                $perso1->frapper($perso2);
                $perso2->frapper($perso1);
                $perso1->bouleDeFeu($perso2);
                $perso2->attaqueBrutale($perso1);
                */
                while ($perso1->checkVitality($perso2) && $perso2->checkVitality($perso1)){
                    if(random_int(1, 3)== 3){
                        $perso2->attaqueBrutale($perso1);
                    }else{
                        $perso2->frapper($perso1);
                    }
                    if(!$perso2->checkVitality($perso1)){
                        exit();
                    }
                    if(random_int(1, 3)== 3){
                        $perso1->bouleDeFeu($perso2);
                    }else{
                        $perso1->frapper($perso2);
                    }
                    if(!$perso1->checkVitality($perso2)){
                        exit();
                    }
                }
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
