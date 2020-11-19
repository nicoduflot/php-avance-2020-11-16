<?php
require "../../vendor/autoload.php";
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
        <?php
        if(isset($_POST["creaPerso"]) && $_POST["creaPerso"] === "creaPerso"){
            echo "CreaPerso";
            $classePerso = $_POST["classe"];
            //$perso = new $_POST["classe"];
            $nomPerso = ($_POST["nom"] !== "" ? $_POST["nom"] : "John Doe");
            $nomArme = ($_POST["nomArme"] !== "" ? $_POST["nomArme"] : "Gertrude");
            if($_POST["niveauArme"] === "0"){
                $nomArme = "Mains Nues";
            }
            $niveauArme = $_POST["niveauArme"];
            switch ($classePerso){
                case "Personnage":
                    $perso = new Personnage($nomPerso, new Arme($nomArme, $niveauArme));
                    break;
                case "Mage":
                    $perso = new Mage($nomPerso, new Arme($nomArme, $niveauArme));
                    break;
                case "Guerrier":
                    $perso = new Guerrier($nomPerso, new Arme($nomArme, $niveauArme));
                    break;
                default:
                    $perso = new Personnage($nomPerso, new Arme($nomArme, $niveauArme));

            }
            echo "<pre>";
            print_r($perso);
            echo "<pre>";
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
