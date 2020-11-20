<?php

use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;

function createPerso($classePerso, $nomPerso, $nomArme, $niveauArme){
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
    $req = $bdd->prepare($sql);
    $req->execute(array("idperso"=>$idPerso)) or die(print_r($bdd->errorInfo()));
    return $req;
}

function loadPerso($donnees){
    $perso = createPerso($donnees["nomclasse"],$donnees["nomperso"], $donnees["nom_arme"], $donnees["niveau_degats"]);
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
