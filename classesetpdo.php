<?php
require "vendor/autoload.php";
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
        <article class="col-lg-12">
            <h1>Classes Etendues et PDO</h1>
            <h2>Principes</h2>
            <p>
                Nous allons associer la création d'objet avec des données
                pré-enregistrées ou enregistrer de nouveaux personnages
            </p>
            <p>
                Créons :
            </p>
            <ul>
                <li><a href="./src/includes/creaPerso.php?classe=Personnage">Un personnage lambda</a></li>
                <li><a href="./src/includes/creaPerso.php?classe=Personnage">Un Mage</a></li>
                <li><a href="./src/includes/creaPerso.php?classe=Personnage">Un Guerrier</a></li>
            </ul>
            <?php
            try {
                $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
                    "root",
                    "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
                //$bdd->
            }catch(Exception $e){
                die("Erreur connexion : " . $e->getMessage());
            }

            $sql =  "SELECT".
                " `p`.`id` as `idperso`, `p`.`nom` as `nomperso`, `cp`.`nom` as `nomclasse`, `p`.`uniqueid` ".
                " FROM ".
                "   `personnage` as `p` LEFT JOIN ".
                "   `classe_personnage` as `cp` on ".
                "   `p`.`id_classe` = `cp`.`id`";
            echo $sql."<br />";
            $req = $bdd->prepare($sql);
            $req->execute() or die(print_r($bdd->errorInfo()));
            ?>
            <div style="max-height: 200px;overflow: auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Classe</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($donnees = $req->fetch()){
                        ?>
                        <tr id="<?php echo $donnees["idperso"]; ?>">
                            <td><?php echo $donnees["nomperso"]; ?></td>
                            <td><?php echo $donnees["nomclasse"]; ?></td>
                            <td>Charger <?php echo $donnees["uniqueid"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            $req->closeCursor();
            ?>
        </article>
    </section>
</main>
<footer>
    &copy;Dawan
</footer>
</body>
</html>
