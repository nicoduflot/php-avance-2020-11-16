<?php
require "../../vendor/autoload.php";
use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;
include "./functions.php";
$errorPerso = "";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Php Avancé</title>
    <?php
    include "./backheadCalls.php";
    ?>
</head>
<body>
<header>
    <h1>POO : Programmation Orientée Objet</h1>
</header>
<main class="container">
    <section class="row">
        <article class="col-lg-10">
            <p>
                <a href="../../classesetpdo.php">Retour</a>
            </p>
            <?php
            if(isset($_GET["idPerso"]) && $_GET["idPerso"] !== ""){
                $idPerso = $_GET["idPerso"];
                $req = getPersoData($idPerso);
                $perso1 = generatePerso($req);
                //génération du "méchant"
                $reqEnemy = getPersoData(randomEnemy($idPerso));
                $perso2 = generatePerso($reqEnemy);
                ?>
                <h3>
                    <?php
                    echo $perso1->getName()." rencontre ".$perso2->getName()." qui le défie en combat"
                    ?>
                </h3>
                <?php
                autoCombat($perso1, $perso2);
            }else{
                echo "<h3>Ce personnage n'existe pas</h3>";
            }
            ?>
        </article>
    </section>
</main>
