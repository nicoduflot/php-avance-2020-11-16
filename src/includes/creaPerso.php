<?php
require "../../vendor/autoload.php";
use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;
include "./functions.php";

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
            <a href="../../classesetpdo.php">Retour</a>
        <?php
        if(isset($_POST["creaPerso"]) && $_POST["creaPerso"] === "creaPerso"){
            $classePerso = $_POST["classe"];
            $nomPerso = ($_POST["nom"] !== "" ? $_POST["nom"] : "John Doe");
            $nomArme = ($_POST["nomArme"] !== "" ? $_POST["nomArme"] : "Mains nues");
            $niveauArme = $_POST["niveauArme"];
            if($_POST["niveauArme"] === "0" || $_POST["niveauArme"] === ""){
                $nomArme = "Mains Nues";
                $niveauArme = 0;
            }
            $perso = createPerso($classePerso, $nomPerso, $nomArme, $niveauArme);
            ?>
            <div class="row">
                <header class="col-lg-12">
                    <h1><?php echo $classePerso." créé !"; ?></h1>
                </header>
                <p>
                    <?php
                    $tabPerso = [];
                    $tabPerso["uniqueid"] = $perso->getUniqId();
                    $tabPerso["nom"] = $perso->getName();
                    $tabPerso["classe"] = $classePerso;
                    $tabPerso["strength"] = $perso->getForce();
                    $tabPerso["vigueur"] = $perso->getVigueur();
                    $tabPerso["max_degats"] = $perso->getMaxDegats();
                    $tabPerso["nomArme"] = $perso->getArme()->getNom();
                    $tabPerso["niveauArme"] = $niveauArme;
                    $tabPerso["bonus_degats"] = $perso->getBonusDegats();
                    $tabPerso["mana"] = $perso->getMana();
                    $tabPerso["furie"] = $perso->getFurie();
                    ?>
                </p>
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

                    Dégât : <?php echo $perso->getArme()->getTabDegats()[$_POST["niveauArme"]]; ?>
                </div>
                <div class="col-lg-4">
                    Bonus Dégâts : <?php echo $perso->getBonusDegats(); ?>
                </div>
            </div>
            <div class="enregPerso" style="opacity: 0;width: 0;height: 0"><?php echo json_encode($tabPerso); ?></div>
            <div class="row">
                <button type="button" class="btn btn-primary" id="enregPerso" name="enregPerso">
                    enregistrer le personnage
                </button>
            </div>
            <?php
        }elseif(isset($_GET["classe"]) && $_GET["classe"] !== ""){
                $classePerso = $_GET["classe"];
                ?>
                <h2>Créer un personnage de classe : <?php echo $classePerso; ?></h2>
                <form method="post" action="./creaPerso.php">
                    <fieldset class="form-group">
                        <label for="nom">Nom de votre personnage</label>
                        <input type="text" name="nom" id="nom" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="nomArme">Nom de l'arme</label>
                        <input type="text" name="nomArme" id="nomArme" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="niveauArme">Niveau de l'arme</label>
                        <select name="niveauArme" id="niveauArme" value="Mains Nues">
                            <option value="0">0 - mains nue</option>
                            <option value="1">1 - Faible</option>
                            <option value="2">2 - Moyen</option>
                            <option value="3">3 - Puissant</option>
                        </select>
                    </fieldset>
                    <input type="hidden" name="classe" id="classe" value="<?php echo $classePerso; ?>" />
                    <button class="btn btn-primary" type="submit" name="creaPerso" id="creaPerso" value="creaPerso" />
                        Créer le perso
                    </button>
                </form>
                <?php

            }else{
                echo "oups !<br />";
                echo "<a href=\"../../classesetpdo.php\">revenir en arrière</a>";
                header("location: ../../classesetpdo.php");
                exit();
        }
        ?>
        </article>
    </section>
</main>
<footer>
    &copy;Dawan
</footer>
</body>
</html>
