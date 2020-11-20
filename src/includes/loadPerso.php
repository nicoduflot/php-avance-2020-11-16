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
                if($req->rowCount()>0){
                    $donnees = $req->fetch(PDO::FETCH_ASSOC);
                    $perso = loadPerso($donnees);
                    ?>
                    <div class="row">
                        <header class="col-lg-12">
                            <h1><?php echo $perso->getName()." le ".$donnees["nomclasse"]; ?></h1>
                        </header>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            Nom : <?php echo $perso->getName(); ?>
                        </div>
                        <div class="col-lg-4">
                            Force : <?php echo $perso->getForce(); ?>
                        </div>
                        <div class="col-lg-4">
                            Max Dégâts : <?php echo $perso->getMaxDegats(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            Vigueur : <?php echo $perso->getVigueur(); ?>
                        </div>
                        <div class="col-lg-4">
                            Mana : <?php echo $perso->getMana(); ?>
                        </div>
                        <div class="col-lg-4">
                            Furie : <?php echo $perso->getFurie(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            Arme : <?php echo $perso->getArme()->getNom(); ?>

                            Dégât : <?php echo $perso->getArme()->getTabDegats()[$donnees["niveau_degats"]]; ?>
                        </div>
                        <div class="col-lg-4">
                            Bonus Dégâts : <?php echo $perso->getBonusDegats(); ?>
                        </div>
                    </div>
                    <?php
                    $req->closeCursor();
                }else{
                    $errorPerso .= "<h3>Ce personnage n'existe pas</h3>";
                }
                //génération du "méchant"
                $req = getPersoData(randomEnemy($idPerso));
                if($req->rowCount()>0){
                    $donnees = $req->fetch(PDO::FETCH_ASSOC);
                    $perso2 = loadPerso($donnees);
                    ?>
                    <div class="row">
                        <header class="col-lg-12">
                            <h1><?php echo $perso2->getName()." le ".$donnees["nomclasse"]; ?></h1>
                        </header>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            Nom : <?php echo $perso2->getName(); ?>
                        </div>
                        <div class="col-lg-4">
                            Force : <?php echo $perso2->getForce(); ?>
                        </div>
                        <div class="col-lg-4">
                            Max Dégâts : <?php echo $perso2->getMaxDegats(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            Vigueur : <?php echo $perso2->getVigueur(); ?>
                        </div>
                        <div class="col-lg-4">
                            Mana : <?php echo $perso2->getMana(); ?>
                        </div>
                        <div class="col-lg-4">
                            Furie : <?php echo $perso2->getFurie(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            Arme : <?php echo $perso2->getArme()->getNom(); ?>

                            Dégât : <?php echo $perso2->getArme()->getTabDegats()[$donnees["niveau_degats"]]; ?>
                        </div>
                        <div class="col-lg-4">
                            Bonus Dégâts : <?php echo $perso2->getBonusDegats(); ?>
                        </div>
                    </div>
                    <?php
                    $req->closeCursor();
                }else{
                    $errorPerso .= "<h3>Ce personnage n'existe pas</h3>";
                }
                ?>
                <?php
                while ($perso->checkVitality($perso2) && $perso2->checkVitality($perso)){
                    if(random_int(1, 3)== 3){
                        $perso2->multi($perso);
                    }else{
                        if(random_int(1, 3)== 3){
                            $perso2->seRestaurer(1);
                        }else{
                            $perso2->frapper($perso);
                        }
                    }
                    if(!$perso2->checkVitality($perso)){
                        exit();
                    }
                    if(random_int(1, 3)== 3){
                        $perso->multi($perso2);
                    }else{
                        if(random_int(1, 3)== 3){
                            $perso->seRestaurer(1);
                        }else{
                            $perso->frapper($perso2);
                        }
                    }

                    if(!$perso->checkVitality($perso2)){
                        exit();
                    }
                }
                ?>
            <?php

            }else{
                $errorPerso .= "<h3>Ce personnage n'existe pas</h3>";
            }
            ?>
        </article>
    </section>
</main>
