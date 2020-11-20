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
                try {
                    $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
                        "root",
                        "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
                    //$bdd->
                } catch (Exception $e) {
                    die("Erreur connexion : " . $e->getMessage());
                }
//`p`.``

                /*
                $tabPerso["uniqueid"] = $perso->getUniqId();
                    $tabPerso["nom"] = $perso->getName();
                    $tabPerso["id_classe"] = $classePerso;
                    $tabPerso["strength"] = $perso->getForce();
                    $tabPerso["vigueur"] = $perso->getVigueur();
                    $tabPerso["max_degats"] = $perso->getMaxDegats();
                    $tabPerso[""] = $perso->getArme()->getNom();
                    $tabPerso["niveauArme"] = $niveauArme;
                    $tabPerso["bonus_degats"] = $perso->getBonusDegats();
                    $tabPerso["mana"] = $perso->getMana();
                    $tabPerso["furie"] = $perso->getFurie();
                 */
                $sql =  " SELECT " .
                        "   `p`.`id` as `idperso`, `p`.`nom` as `nomperso`, `cp`.`nom` as `nomclasse`, " .
                        "   `p`.`uniqueid`, `a`.`nom` as `nom_arme`, `a`.`niveau_degats`, " .
                        "   `p`.`strength`, `p`.`vigueur`, `p`.`max_degats`, `p`.`id_localisation`,   ".
                        "   `l`.`nom` as `localisation`, `p`.`experience`, `p`.`degats` ".
                        "   ".
                        "".
                        " FROM " .
                        "   `personnage` as `p` LEFT JOIN " .
                        "   `classe_personnage` as `cp` ON `p`.`id_classe` = `cp`.`id` LEFT JOIN " .
                        "   `arme` as `a` ON `p`.`id_arme` = `a`.`id` LEFT JOIN ".
                        "   `localisation` as `l` ON `l`.`id` = `p`.`id_localisation` ".
                        " WHERE `p`.`id` = :idperso; ";
                $req = $bdd->prepare($sql);
                //echo $sql;
                $req->execute(array("idperso"=>$idPerso)) or die(print_r($bdd->errorInfo()));
                if($req->rowCount()>0){
                    $donnees = $req->fetch(PDO::FETCH_ASSOC);
                    echo "<pre>";
                    var_dump($donnees);
                    echo "</pre>";
                    $perso = createPerso($donnees["nomclasse"],$donnees["nomperso"], $donnees["nom_arme"], $donnees["niveau_degats"]);

                    $perso->setForce($donnees["strength"]);
                    $perso->setVigueur($donnees["vigueur"]);
                    $perso->setMaxDegats($donnees["max_degats"]);
                    $perso->setLocalisation($donnees["localisation"]);
                    $perso->setExperience($donnees["experience"]);
                    $perso->setDegats($donnees["degats"]);
                    echo "<pre>";
                    var_dump($perso);
                    echo "</pre>";

                }else{
                        $errorPerso .= "<h3>Ce personnage n'existe pas</h3>";
                }
            }else{
                $errorPerso .= "<h3>Ce personnage n'existe pas</h3>";
            }


            ?>
        </article>
    </section>
</main>
