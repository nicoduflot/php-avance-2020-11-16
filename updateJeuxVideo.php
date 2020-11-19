<?php
require "vendor/autoload.php";
use Doctrine\Common\Collections\ArrayCollection;

//variables pour gérer les associations de conditions
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

if (isset($_GET["action"]) && $_GET["action"] === 'modifJeu') {
    if (isset($_GET["idJeu"]) && $_GET["idJeu"] !== "") {
        $idJeu = $_GET["idJeu"];
        $sql = "SELECT * FROM `jeux_video` WHERE ID = :idJeux";
        $req = $bdd->prepare($sql);
        $req->execute(array("idJeux" => $idJeu)) or die(print_r($bdd->errorInfo()));
        $donnees = $req->fetch();
        $req->closeCursor();
    }else{
        $messageUpdate = "<p>Aucun jeu sélectionné ou jeu manquant</p>";
    }
}else{
    if(isset($_POST["modifJeu"]) && $_POST["modifJeu"] === "modifJeu"){
        $idJeu = $_POST["idJeu"];
        $sql = "UPDATE `jeux_video` "
                    ."SET "
                    ." `nom` = ". ":nom, "
                    ." `possesseur` = ". ":possesseur, "
                    ." `console` = ". ":console, "
                    ." `prix` = ". ":prix, "
                    ." `nbre_joueurs_max` = ". ":nbre_joueurs_max, "
                    ." `commentaires` = ". ":commentaires, "
                    ." `date_modif` = now() "
                    ." WHERE ID = :idJeux";
        $params["idJeux"]= $idJeu;
        $params["nom"]= $_POST["nom"];
        $params["possesseur"]= $_POST["possesseur"];
        $params["console"]= $_POST["console"];
        $params["prix"]= $_POST["prix"];
        $params["nbre_joueurs_max"]= $_POST["nbre_joueurs_max"];
        $params["commentaires"]= $_POST["commentaires"];

    }else{
        $messageUpdate = "<p>Aucun jeu sélectionné ou jeu manquant</p>";
    }
}




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
        <article class="col-lg-8 offset-2">
            <h1>Modification d'un jeu : </h1>
            <?php echo $messageUpdate; ?>
            <?php
            if (isset($_GET["action"]) && $_GET["action"] === 'modifJeu') {
                if (isset($_GET["idJeu"]) && $_GET["idJeu"] !== "") {
                    ?>
                    <pre>
                        <?php
                        //print_r($donnees);
                        ?>
                    </pre>
                    <form method="post" action="./updateJeuxVideo.php">
                        <!--
                        [ID] => 1
                        [nom] => Super Mario Bros
                        [possesseur] => Florent
                        [console] => NES
                        [prix] => 4
                        [nbre_joueurs_max] => 1
                        [commentaires] => Un jeu d'anthologie !
                        -->
                        <fieldset class="form-group">
                            <div class="row">
                                <label for="nom" class="col-lg-4">nom jeu</label>
                                <input type="text" class="col-lg-8" name="nom" id="nom" value="<?php echo $donnees["nom"]; ?>" />
                            </div>

                        </fieldset>
                        <fieldset class="form-group row">
                            <label for="possesseur" class="col-lg-4">possesseur</label>
                            <input type="text" class="col-lg-8" name="possesseur" id="possesseur" value="<?php echo $donnees["possesseur"]; ?>" />
                        </fieldset>
                        <fieldset class="form-group row">
                            <label for="console" class="col-lg-4">console</label>
                            <input type="text" class="col-lg-8" name="console" id="console" value="<?php echo $donnees["console"]; ?>"/>
                        </fieldset>
                        <fieldset class="form-group row">
                            <label for="prix" class="col-lg-4">prix</label>
                            <input type="text" class="col-lg-8" name="prix" id="prix" value="<?php echo $donnees["prix"]; ?>" />
                        </fieldset>
                        <fieldset class="form-group row">
                            <label for="nbJmax" class="col-lg-4">nbJmax</label>
                            <input type="text" class="col-lg-8" name="nbre_joueurs_max" id="nbre_joueurs_max" value="<?php echo $donnees["nbre_joueurs_max"]; ?>" />
                        </fieldset>
                        <fieldset class="form-group row">
                            <label for="commentaires" class="col-lg-12">Commentaires</label><br />
                            <textarea class="col-lg-12" name="commentaires" id="commentaires"><?php echo $donnees["commentaires"]; ?></textarea>
                        </fieldset>
                        <input type="hidden" name="idJeu" value="<?php echo $donnees["ID"]; ?>">
                        <button class="btn btn-primary" type="submit" name="modifJeu" id="modifJeu" value="modifJeu">
                            Modifier le jeu
                        </button>
                    </form>
            <?php
                }
            }else{
                if(isset($_POST["modifJeu"]) && $_POST["modifJeu"] === "modifJeu"){
                    echo "<p>".$sql."</p>";
                    echo "<pre>";
                    print_r($params);
                    echo "</pre>";
                    $req = $bdd->prepare($sql);
                    $req->execute($params) or die("<pre>".print_r($bdd->errorInfo())."</pre>");
                    //$donnees = $req->fetch();
                    $req->closeCursor();
                    header("location: ./pdo.php#resUpdateJeux-".$idJeu);
                    exit();
                }
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
