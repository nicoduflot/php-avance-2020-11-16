<?php
require "vendor/autoload.php";
use Doctrine\Common\Collections\ArrayCollection;
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
        <article class="col-lg-4">
            <h1>PDO</h1>
            <h2>Principes</h2>
            <p>
                PDO ou "Php Data Object" est un moyen de se connecter à une base de données et un moyen
                de manipuler cette bdd. Son avantage tiens dans le fait qu'on utilise les mêmes méthodes pour
                manipuler des bases de données différentes (MySql, PostGre, Oracle, etc.).
            </p>
            <h2>Connexion avec PDO</h2>
            <p>
                Il faut pour se connecter :
            </p>
            <ul>
                <li>L'hôte</li>
                <li>le nom de la bdd</li>
                <li>le charset utilisé dans la bdd</li>
                <li>identifiant utilisateur bdd</li>
                <li>mot de passe utilisateur bdd</li>
            </ul>
            <p>
                new PDO("mysql:host=&lsaquo;nom de l'hôte&rsaquo;;dbname=&lsaquo;nom bdd&rsaquo;;
                charset=&lsaquo;jeu de caractère bdd&rsaquo;", "&lsaquo;nom de l'utilisateur&rsaquo;",
                "&lsaquo;mdp utilisateur&rsaquo;");
            </p>
            <code>
                //exemple<br />
                $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf-8", "root", "");
            </code>
            <h3>Tester la connexion</h3>
            <?php
            try {
                $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf8",
                    "root",
                    "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
                //$bdd->
            }catch(Exception $e){
                die("Erreur connexion : " . $e->getMessage());
            }
            ?>
        </article>
        <article class="col-lg-8">
            <h1>Requêter avec PDO</h1>
            <p>
                On peut utiliser la méthode query
            </p>
            <code>
                $response = $bdd->query("SELECT * FROM `jeux_video`");
            </code>
            <?php
            $response = $bdd->query("SELECT * FROM `jeux_video`") or die(print_r($bdd->errorInfo()));
            //print_r($response); // n'affiche pas les enregistrements, mais seulement
            // les information concernant la requête
            ?>
            <p>
                $response contient désormais le jeu d'enregistrements récupéré via la requête.
                On ne peut pas exploiter $response directement, il va falloir utliser les méthodes
                de PDO désormais utilisables avec $response.
            </p>
            <code>
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);<br />
                print_r($unEnregistrement);<br />
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);<br />
                print_r($unEnregistrement);<br />
            </code>
            <pre>
            <?php
            $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
            print_r($unEnregistrement);
            ?>
            </pre>
            <pre>
            <?php
            $unEnregistrement = $response->fetch(PDO::FETCH_BOTH);
            print_r($unEnregistrement);
            echo $unEnregistrement['nom'];
            ?>
            </pre>
            <p>
                fetch() renvoie l'enregistrement actuel où se trouve le curseur dans le jeu d'enregistrement.
                Une fois qu'il a renvoyé les données, le curseur passe à l'enregistrement suivant.
            </p>
            <p>
                Il faut, une fois qu'on a finit d'utiliser les données, "fermer" le curseur.
            </p>
            <code>
                $response->closeCursor();
            </code>
            <?php
            $response->closeCursor();
            ?>
        </article>
    </section>
    <section class="row">
        <article class="col-lg-12">
            <h1>Exploiter les résultats</h1>
            <p>
                Maintenant, on relance la requête et on va afficher les résultats
                dans un tableau généré par une boucle
            </p>
            <?php
            $response = $bdd->query("SELECT * FROM `jeux_video` ORDER BY `nom`");
            ?>
            <div style="max-height: 200px;overflow: auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Jeu</th>
                        <th>Possesseur</th>
                        <th>Prix</th>
                        <th>Console</th>
                        <th>nb joueurs max</th>
                        <th>Commentaire</th>
                        <th>Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($donnees = $response->fetch()){
                    ?>
                        <tr id="resUpdateJeux-<?php echo $donnees["ID"]; ?>">
                            <td><?php echo $donnees["nom"]; ?></td>
                            <td><?php echo $donnees["possesseur"]; ?></td>
                            <td><?php echo $donnees["prix"]; ?></td>
                            <td><?php echo $donnees["console"]; ?></td>
                            <td><?php echo $donnees["nbre_joueurs_max"]; ?></td>
                            <td><?php echo $donnees["commentaires"]; ?></td>
                            <td>
                                <a href="./updateJeuxVideo.php?action=modifJeu&idJeu=<?php echo $donnees["ID"]; ?>">
                                    <button class="btn btn-primary">
                                        Modifier
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger supJeu" data-toggle="modal" data-target="#modalSup" data-idjeu="<?php echo $donnees["ID"]; ?>">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modalSup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce jeu ?
                        </div>
                        <input type="hidden" id="idJeuSup" value="" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="validSupJeu" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $response->closeCursor();
            ?>
        </article>
    </section>
    <section class="row">
        <article class="col-lg-12">
            <h2>Les requêtes préparées</h2>
            <p>
                Si on veut pouvoir choisir des paramètres pour la recherche (comme des filtres), il faut utiliser
                les méthodes PDO de préparation de requête.
            </p>
            <form method="get">
                <fieldset class="form-group">
                    <label for="possesseur">Possesseur</label>
                    <input type="text" name="possesseur" id="possesseur" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="prixmax">Prix max</label>
                    <input type="number" name="prixmax" id="prixmax" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="console">Console</label>
                    <input type="text" name="console" id="console" />
                </fieldset>
                <button class="btn btn-primary" name="soumettre" type="submit" value="soumettre">Rechercher</button>
            </form>
            <?php

            //variables pour gérer les associations de conditions
            $conditions = "";
            $nbCondition = 0;
            $case = null;
            $tabField = [];
            $tabConditions = new ArrayCollection();

            //gestion des champs de filtre
            if(isset($_GET["soumettre"]) && $_GET["soumettre"] === 'soumettre'){
                if(isset($_GET["possesseur"]) && $_GET["possesseur"] !== ""){
                    $tabField["possesseur"] = $_GET["possesseur"];
                    $tabConditions->add(" possesseur = :possesseur ");
                }
                if(isset($_GET["prixmax"]) && $_GET["prixmax"] !== ""){
                    //$tabField->add("prixmax;".$_GET["prixmax"]);
                    $tabField["prixmax"] = $_GET["prixmax"];
                    $tabConditions->add(" prix <= :prixmax ");
                }
                if(isset($_GET["console"]) && $_GET["console"] !== ""){
                    //$tabField->add("console;".$_GET["console"]);
                    $tabField["console"] = $_GET["console"];
                    $tabConditions->add(" console = :console ");
                }
            }

            //fin gestion des champs de filtre
            //préparation de la requête
            if($tabConditions->count() !== 0){
                for($i = 0; $i < $tabConditions->count(); $i++){
                    if($i=== 0){
                        $conditions .= " WHERE ";
                    }else{
                        $conditions .= " AND ";
                    }
                    $conditions .= $tabConditions[$i];
                }
            }

            $sql = "SELECT * FROM `jeux_video` ".$conditions. " ORDER BY `nom`";
            echo $sql."<br /><pre>";
            print_r($tabField);
            echo "</pre><br />";

            echo "<pre>";
            print_r($tabConditions);
            echo "</pre><br />";
            echo "<pre>";
            echo $conditions;
            echo "</pre><br />";

            $req = $bdd->prepare($sql);
            $req->execute($tabField);

            ?>
            <div style="max-height: 200px;overflow: auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Jeu</th>
                        <th>Possesseur</th>
                        <th>Prix</th>
                        <th>Console</th>
                        <th>nb joueurs max</th>
                        <th>Commentaire</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($donnees = $req->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $donnees["nom"]; ?></td>
                            <td><?php echo $donnees["possesseur"]; ?></td>
                            <td><?php echo $donnees["prix"]; ?></td>
                            <td><?php echo $donnees["console"]; ?></td>
                            <td><?php echo $donnees["nbre_joueurs_max"]; ?></td>
                            <td><?php echo $donnees["commentaires"]; ?></td>
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
    <section class="row">
        <article class="col-lg-6">
            <h1>Voir les erreurs</h1>
            <p>en ajoutant :</p>
            <code>
                $bdd = new PDO(
                "mysql:host=localhost;dbname=php-avance;charset=utf8",
                "root",
                "",
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            </code>
            <p>
                si les requêtes utilisées sont en erreur, des erreurs lisibles seront affichées.
            </p>
            <p>
                On peut améliorer l'affichage des erreurs en ajoutant quelque chose lors de la requête :
            </p>
            <code>
                $response = $bdd->query("SELECT * FROM `jeux_video`")
                or die(print_r($bdd->errorInfo()));
            </code>
        </article>
        <article class="col-lg-6">
            <h1>Manipulation des enregistrements</h1>
            <h2>Ajoût de données</h2>
            <form method="post">
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
                    <label for="nom">nom jeu</label>
                    <input type="text" name="nom" id="nom" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="possesseur">possesseur</label>
                    <input type="text" name="possesseur" id="possesseur" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="console">console</label>
                    <input type="text" name="console" id="console" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="prix">prix</label>
                    <input type="text" name="prix" id="prix" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="nbJmax">nbJmax</label>
                    <input type="text" name="nbJmax" id="nbJmax" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="commentaires">Commentaires</label><br />
                    <textarea name="commentaires" id="commentaires"></textarea>
                </fieldset>
                <button class="btn btn-primary" type="submit" name="ajoutJeu" id="ajoutJeu" value="ajoutJeu">
                    Ajouter le jeu</button>
            </form>
            <?php

            //variables pour gérer les associations de conditions
            $tabField = [];

            //gestion des champs de filtre
            if(isset($_POST["ajoutJeu"]) && $_POST["ajoutJeu"] === "ajoutJeu"){
                if(isset($_POST["nom"]) && $_POST["nom"] !== ""){
                    $tabField["nom"] = $_POST["nom"];
                }
                if(isset($_POST["possesseur"]) && $_POST["possesseur"] !== ""){
                    $tabField["possesseur"] = $_POST["possesseur"];
                }
                if(isset($_POST["console"]) && $_POST["console"] !== ""){
                    $tabField["console"] = $_POST["console"];
                }
                if(isset($_POST["prix"]) && $_POST["prix"] !== ""){
                    $tabField["prix"] = $_POST["prix"];
                }
                if(isset($_POST["nbJmax"]) && $_POST["nbJmax"] !== ""){
                    $tabField["nbre_joueurs_max"] = $_POST["nbJmax"];
                }
                if(isset($_POST["commentaires"]) && $_POST["commentaires"] !== ""){
                    $tabField["commentaires"] = $_POST["commentaires"];
                }

                //fin gestion des champs de filtre
                //préparation de la requête
                $keys = " (";
                $values = "(";
                $i = 0;
                foreach ($tabField as $key =>$value){
                    echo "{$key} => {$value}<br />";
                    if($i !== 0 && $i < count($tabField)){
                        $keys .= ", ";
                        $values .= ", ";
                    }
                    $i++;
                    $keys .= $key;
                    $values .= ":".$key;
                }
                $keys .= " )";
                $values .= ")";
                $sql = "INSERT INTO `jeux_video` ".$keys." VALUES ".$values." ;";

                echo "<p>KEYS: ".$keys ."</p>";
                echo "<p>VALUES: ".$values ."</p>";

                echo $sql."<p><pre>";
                print_r($tabField);
                echo "</pre></p>";

                $req = $bdd->prepare($sql);
                $req->execute($tabField) or die(print_r($bdd->errorInfo()));
            }

            ?>
        </article>
    </section>
    <section class="row">
        <article class="col-lg-12">
            <h1>Requête d'agrégation</h1>
            <p>
                L'agrégation en SQL permet de regrouper les résultats en utilisant des sommes, du dénombrage, etc.
                Pour utiliser la somme ou le dénombrage, il faut généralement grouper les résultats dans les conditions
                de la requête.
            </p>
            <h2>GROUP BY</h2>
            <p>
                GROUP by permet de regrouper les résultat par colonne. Cela ne sert pas à grand chose
                si vous n'utilisez pas une fonction d'agrégation (count(), sum() par exemple).
            </p>
            <h2>count()</h2>
            <p>
                Count permet de compter les itération d'une colonne lors d'un regroupement.
            </p>
            <pre>
SELECT
	`console`, count(ID) as `nb_jeu_console`
FROM
	`jeux_video`
group by
	`console`
            </pre>
            <?php
                $sql =  "SELECT".
                        " `console`, count(ID) as `nb_jeu_console` ".
                        " FROM ".
                        "   `jeux_video` ".
                        " group by ".
                        "   `console`";
                $req = $bdd->prepare($sql);
                $req->execute() or die(print_r($bdd->errorInfo()));
            ?>
            <div style="max-height: 200px;overflow: auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Console</th>
                        <th>nb jeux console</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($donnees = $req->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $donnees["console"]; ?></td>
                            <td><?php echo $donnees["nb_jeu_console"]; ?></td>
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
            <h2>Somme (sum())</h2>
            <p>
                Pour utiliser sum(), il faut tout d'abord l'utiliser sur une valeur
                numérique, et ensuite utiliser un groupement.
            </p>
            <pre>
SELECT
	`console`, sum(`prix`) as `total_vente_par_console`
FROM
	`jeux_video`
group by
	`console`
            </pre>
            <?php
            $sql =  "SELECT".
                " `console`, sum(`prix`) as `total_vente_par_console` ".
                " FROM ".
                "   `jeux_video` ".
                " group by ".
                "   `console`";
            $req = $bdd->prepare($sql);
            $req->execute() or die(print_r($bdd->errorInfo()));
            ?>
            <div style="max-height: 200px;overflow: auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Console</th>
                        <th>Total vente parx console</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($donnees = $req->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $donnees["console"]; ?></td>
                            <td><?php echo $donnees["total_vente_par_console"]; ?></td>
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
<?php
include "./src/includes/footer.php";
?>
</body>
</html>
