<?php
$idJeu = null;
$messageUpdate = "";
$sql = null;

try {
    $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
        "root",
        "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
    //$bdd->
}catch(Exception $e){
    die("Erreur connexion : " . $e->getMessage());
}

if(isset($_GET["idJeu"]) && $_GET["idJeu"] !== ""){
    $idJeu = $_GET["idJeu"];
    $sql = "DELETE FROM `jeux_video` WHERE ID = :idJeux";
    $req = $bdd->prepare($sql);
    $req->execute(array("idJeux" => $idJeu)) or die(print_r($bdd->errorInfo()));
    //$donnees = $req->fetch();
    $req->closeCursor();
}
