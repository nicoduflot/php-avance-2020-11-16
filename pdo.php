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
            $response = $bdd->query("SELECT * FROM `jeux_video`");
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
            $response = $bdd->query("SELECT * FROM `jeux_video`");
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
                    while ($donnees = $response->fetch()){
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
            $response->closeCursor();
            ?>
        </article>
    </section>
</main>
</body>
</html>
