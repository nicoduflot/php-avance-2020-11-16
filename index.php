<?php
// sans autoload, on appelle les classes comme ça :
// require "./src/Classes/Personnage.php";
// en créant un fichier autoload :
//include "./src/includes/autoload.php";
// en utilisant psr-4
require "vendor/autoload.php";
use App\Personnage;
use App\Arme;

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
                    <h1>Programmation Orientée Objet</h1>
                    <h2>Principes</h2>
                    <p>
                        Caractéristiques (variables ou des attributs) et des capacités (des méthodes).
                    </p>
                    <p>
                        On va créer une classe Personnage, un personnage de jeu.
                    </p>
                    <p>
                        Caractéristiques (variables ou attirbuts) du personnage :
                    </p>
                    <ul>
                        <li>Nom</li>
                        <li>Prénom</li>
                        <li>Où il se trouve dans le donjon : localisation</li>
                        <li>Expérience</li>
                        <li>Les dégâts qu'il reçoit</li>
                    </ul>
                    <p>
                        Ses capacités (méthodes)
                    </p>
                    <ul>
                        <li>Frapper</li>
                        <li>Gagner de l'expérience</li>
                        <li>Se déplacer</li>
                    </ul>
                    <h2>Instance</h2>
                    <p>
                        Personnage c'est l'objet général, et un personnage créé à l'aide de cette classe
                        sera une instance de Personnage
                    </p>
                    <h2>Encapsulation</h2>
                    <p>
                        DOnc les attributs et les méthodes de Personnage sont encpasulées
                        dans la classe (donc dans l'objet créé). L'utilisateur de l'objet
                        (le codeur) n'aura pas à jouer avec le code de la classe, mais il
                        pourra utiliser les méthodes, ais pas directement les attributs, car
                        ils sont privés.
                    </p>
                    <h2>Créer la classe Personnage</h2>
                    <p>
                        On déclare les attributs en privé.
                    </p>
                    <p>
                        On crée ensuite le "constructeur"
                    </p>
                    <p>
                        Le constructeur va servir à "construireé l'objet lors de son instanciation.
                        Il peut contenir du code et surtout il définit les variables à renseigner
                        lors de l'instanciation.
                    </p>
                    <p>
                        Comme les variables sont privées, pour les lire ou les modifier, il faut passer par des
                        méthodes particulières appelé Getters (Assesseurs) & Setters (Mutateur).
                    </p>
                    <p>
                        Une fois que les getters et setters sont écris, on peut écrire lesméthodes de l'objet
                    </p>
                    <ul>
                        <li>Frapper</li>
                        <li>Gagner de l'expérience</li>
                        <li>Se déplacer</li>
                    </ul>
                    <h2>Utiliser la classe</h2>
                    <?php
                    $perso1 = new Personnage("Joshua", 40, 1, new Arme("Hache", 3));
                    $perso2 = new Personnage("Max", 80, 5, new Arme("Epée", 2));
                    ?>
                    <pre>
                        <?php
                        print_r($perso1);
                        ?>
                    </pre>
                    <pre>
                        <?php
                        print_r($perso2);
                        ?>
                    </pre>
                    <p>
                        <?php
                        echo $perso1->getName(). " a ".$perso1->getForce()." de force, ".$perso1->getExperience().
                            " Point(s) d'expérience et il se trouve dans : ".$perso1->getLocalisation()."<br/>";
                        echo $perso2->getName(). " a ".$perso2->getForce()." de force, ".$perso2->getExperience().
                            " Point(s) d'expérience et il se trouve dans : ".$perso2->getLocalisation()."<br/>";
                        echo $perso1->getName()." a une arme : ".$perso1->getArme()->getNom()." qui fait ".
                            $perso1->getArme()->getNiveauDegats()." dégât(s)<br />";

                        echo $perso1->getName(). " frappe ".$perso2->getName()." (vigueur : ".$perso1->getVigueur().").<br />";
                        $perso1->frapper($perso2);

                        echo $perso2->getName(). " a maintenant ".$perso2->getDegats()." dégât(s)<br />";

                        echo $perso1->getName(). " frappe ".$perso2->getName()."(vigueur : ".$perso1->getVigueur().").<br />";
                        $perso1->frapper($perso2);

                        echo $perso2->getName(). " a maintenant ".$perso2->getDegats()." dégât(s)<br />";

                        echo $perso1->getName(). " frappe ".$perso2->getName()."(vigueur : ".$perso1->getVigueur().").<br />";
                        $perso1->frapper($perso2);

                        echo $perso2->getName(). " a maintenant ".$perso2->getDegats()." dégât(s)<br />";

                        echo $perso1->getName()." prends une potion niveau 1 <br />";
                        $perso1->seRestaurer(1);

                        echo $perso1->getName()." a maintenant ".$perso1->getVigueur()." de vigueur";

                        ?>
                    </p>
                    <?php

                    ?>
                </article>
            </section>
        </main>
        <?php
        include "./src/includes/footer.php";
        ?>
    </body>
</html>
