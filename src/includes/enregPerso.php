<?php
$persoJson = $_GET["json"];
//echo "persoJson : ".$persoJson."<br />";
$perso = json_decode($persoJson);

$uniqueid = $perso->{"uniqueid"};
$nom = $perso->{"nom"};
$classe = $perso->{"classe"};
$strength = $perso->{"strength"};
$vigueur = $perso->{"vigueur"};
$max_degats = $perso->{"max_degats"};
$nomArme = $perso->{"nomArme"};
$niveau_degats = $perso->{"niveauArme"};
$bonus_degats = $perso->{"bonus_degats"};
$mana = $perso->{"mana"};
$furie = $perso->{"furie"};

try {
    $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
        "root",
        "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
    //$bdd->
}catch(Exception $e){
    die("Erreur connexion : " . $e->getMessage());
}

$sqlArme = "SELECT * from `arme` WHERE `nom`= :nomArme;";

$reqArme = $bdd->prepare($sqlArme);
$reqArme->execute(array("nomArme" => $nomArme));

if($reqArme->rowCount() > 0){
    $donnees = $reqArme->fetch();
    $idArme = $donnees["id"];
}else{
    $sqlInsertArme = "INSERT INTO `arme` (`nom`, `niveau_degats`) VALUES( :nom, :niveau_degats); ";
    $reqInserArme = $bdd->prepare($sqlInsertArme);
    $reqInserArme->execute(array("nom" =>$nomArme, "niveau_degats" => $niveau_degats));
    $idArme = $bdd->lastInsertId();
}

$reqArme->closeCursor();

$sqlClasse = "SELECT * from `classe_personnage` WHERE `nom`= :classe;";

$reqClasse = $bdd->prepare($sqlClasse);
$reqClasse->execute(array("classe" => $classe));

if($reqClasse->rowCount() > 0){
    $donnees = $reqClasse->fetch();
    $idClasse = $donnees["id"];
}else{
    $idClasse = 1;
}

$tabPerso = [];
$tabPerso["uniqueid"] = $perso->{"uniqueid"};
$tabPerso["nom"] = $perso->{"nom"};
$tabPerso["id_classe"] = intval($idClasse);
$tabPerso["strength"] = $perso->{"strength"};
$tabPerso["vigueur"] = $perso->{"vigueur"};
$tabPerso["max_degats"] = $perso->{"max_degats"};
$tabPerso["id_arme"] = intval($idArme);
$tabPerso["bonus_degats"] = $perso->{"bonus_degats"};
$tabPerso["mana"] = $perso->{"mana"};
$tabPerso["furie"] = $perso->{"furie"};

$reqClasse->closeCursor();

echo "<pre>";
var_dump($tabPerso);
echo "</pre>";

$keys = " (";
$values = "(";
$i = 0;
foreach ($tabPerso as $key =>$value){
    echo "{$key} => {$value}<br />";
    if($i !== 0 && $i < count($tabPerso)){
        $keys .= ", ";
        $values .= ", ";
    }
    $i++;
    $keys .= $key;
    $values .= ":".$key;
}
$keys .= " )";
$values .= ")";

echo "<pre>";
var_dump($keys);
echo "</pre>";

echo "<pre>";
var_dump($values);
echo "</pre>";

$sql = "INSERT INTO `personnage` ".$keys." VALUES ".$values." ;";
echo $sql;
$req = $bdd->prepare($sql);
$req->execute($tabPerso) or die(print_r($bdd->errorInfo()));

$req->closeCursor();
