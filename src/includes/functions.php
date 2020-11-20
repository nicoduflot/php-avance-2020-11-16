<?php

use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;

// crée le personnage selon la classe
function createPerso($classePerso, $nomPerso, $nomArme = "Mains nues", $niveauArme = 0){
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
            $classePerso = "Personnage";
    }
    return $perso;
}

// Récupère les données du personnage et les retourne dans une requête pdo
function getPersoData($idPerso){
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
            "root",
            "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
        //$bdd->
    } catch (Exception $e) {
        die("Erreur connexion : " . $e->getMessage());
    }
    $sql =  " SELECT " .
        "   `p`.`id` as `idperso`, `p`.`nom` as `nomperso`, `cp`.`nom` as `nomclasse`, " .
        "   `p`.`uniqueid`, `a`.`nom` as `nom_arme`, `a`.`niveau_degats`, " .
        "   `p`.`strength`, `p`.`vigueur`, `p`.`max_degats`, `p`.`id_localisation`,   ".
        "   `l`.`nom` as `localisation`, `p`.`experience`, `p`.`degats`, `p`.`bonus_degats`, ".
        "   `p`.`mana`, `p`.`furie` ".
        " FROM " .
        "   `personnage` as `p` LEFT JOIN " .
        "   `classe_personnage` as `cp` ON `p`.`id_classe` = `cp`.`id` LEFT JOIN " .
        "   `arme` as `a` ON `p`.`id_arme` = `a`.`id` LEFT JOIN ".
        "   `localisation` as `l` ON `l`.`id` = `p`.`id_localisation` ".
        " WHERE `p`.`id` = :idperso; ";
    //echo $sql;
    $req = $bdd->prepare($sql);
    $req->execute(array("idperso"=>$idPerso)) or die(print_r($bdd->errorInfo()));
    return $req;
}

function loadPerso($donnees){
    if($donnees["nom_arme"] === null){
        $nomArme = "Mains nues";
        $niveauDegats = 0;
    }else{
        $nomArme = $donnees["nom_arme"];
        $niveauDegats = $donnees["niveau_degats"];
    }
    $perso = createPerso($donnees["nomclasse"],$donnees["nomperso"], $nomArme, $niveauDegats);
    $perso->setForce($donnees["strength"]);
    $perso->setVigueur($donnees["vigueur"]);
    $perso->setMaxDegats($donnees["max_degats"]);
    $perso->setLocalisation($donnees["localisation"]);
    $perso->setExperience($donnees["experience"]);
    $perso->setDegats($donnees["degats"]);
    $perso->setBonusDegats($donnees["bonus_degats"]);
    $perso->setMana($donnees["mana"]);
    $perso->setFurie($donnees["furie"]);
    return $perso;
}
//renvoi un id de personnage a utiliser comme ennemi
function randomEnemy($idHero){
    $tabIdEnemy = [];
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
            "root",
            "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
        //$bdd->
    } catch (Exception $e) {
        die("Erreur connexion : " . $e->getMessage());
    }
    $sql =  " SELECT " .
        "   `id`".
        " FROM " .
        "   `personnage` as `p` ".
        " WHERE `p`.`id` <> :idperso; ";
    $req = $bdd->prepare($sql);
    $req->execute(array("idperso"=>$idHero)) or die(print_r($bdd->errorInfo()));
    $rowCount = $req->rowCount();
    if($rowCount > 0) {
        while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
            $tabIdEnemy[] = $donnees["id"];
        }
        $req->closeCursor();
        $enemyCell = random_int(0, $rowCount-1);
        return $tabIdEnemy[$enemyCell];
    }else{
        return false;
    }
}

//récupère la requête des données d'un personnage et les affiche dans une fiche de personnage
// retourne l'objet personnage chargé
function generatePerso($req){
    if($req->rowCount()>0){
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        $perso = loadPerso($donnees);
        echo fichePersoTemplate($perso, $donnees);
        $req->closeCursor();
        return $perso;
    }else{
        return false;//$errorPerso = "<h3>Ce personnage n'existe pas</h3>";
    }
}

//template d'une ficher de personnage avec l'objet personnage et les données du personnage en entré
function fichePersoTemplate($perso, $donnees){
    if($donnees["niveau_degats"] === null){
        $niveauDegat = 0;
    }else{
        $niveauDegat = $donnees["niveau_degats"];
    }
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

            Dégât : <?php echo $perso->getArme()->getTabDegats()[$niveauDegat]; ?>
        </div>
        <div class="col-lg-4">
            Bonus Dégâts : <?php echo $perso->getBonusDegats(); ?>
        </div>
    </div>
    <?php
}

function autoCombat($perso1, $perso2){
    while ($perso1->checkVitality($perso2) && $perso2->checkVitality($perso1)){
        if(random_int(1, 3)== 3){
            $perso2->multi($perso1);
        }else{
            if(random_int(1, 3)== 3){
                $perso2->seRestaurer(1);
            }else{
                $perso2->frapper($perso1);
            }
        }

        if(!$perso2->checkVitality($perso1)){
            exit();
        }
        if(random_int(1, 3)== 3){
            $perso1->multi($perso2);
        }else{
            if(random_int(1, 3)== 3){
                $perso1->seRestaurer(1);
            }else{
                $perso1->frapper($perso2);
            }
        }

        if(!$perso1->checkVitality($perso2)){
            exit();
        }
    }
}
