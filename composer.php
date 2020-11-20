<?php
require "vendor/autoload.php";
use App\Test;
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
            <h1>Composer</h1>
            <h2>Principes</h2>
            <p>
                Composer est un gestionnaire de paquet, c'est à dire qu'il va aider à installer
                et gérer des bibliothèques et des dépendances php.
            </p>
            <h2>
                Installer composer
            </h2>
            <p>
                On peut installer composer en téléchargeant l'instaleur windows sur le site de composer. Il
                faut le mettre accessible de partout (ne pas l'installer dans un répertoire spécifique).
            </p>
            <h2>Vérifier l'installation</h2>
            <p>
                Quand vous êtes à la racine d'un répertoire, à l'aide d'une console, on lance la commande
                <code>
                    composer
                </code> puis entrée.
            </p>
            <p>
                Si composer n'est pas installé ou n'est pas accessible depuis le projet, il faut le réinstaller.
                Si il est bien accessible, composer vous répond.
            </p>
            <h2>Initialiser composer</h2>
            <p>
                On va à la racine du projet et on lance dans la console la commande suivante :
                <code>
                    composer init
                </code>
            </p>
            <p>
                vous avez ensuite une série de question auxquelles il faut répondre
            </p>
            <ul>
                <li>Le nom du projet que vous pouvez laisser par défaut</li>
                <li>La description du projet</li>
                <li>L'auteur</li>
                <li>Stabilité minimale, il va permettre de filtrer les librairies par rapport à la valeur qui vous lui attribuez.
                    En tapant <code>stable</code>  tout les packages utilisés doivent être à la version stable.</li>
                <li>Type du package: Ici il s'agit d'un projet, donc on entre <code>project</code></li>
                <li>License: la licence va définir comment les autres personnes pourront utiliser votre projet</li>
                <li>On répond <code>no</code> aux deux dernières questions, pour ne pas jouer avec les interdépendance des paquets.</li>
            </ul>
            <p>
                A la fin, on vous demande de confirmer la génération du fichier <code>composer.json</code> qui
                va être le fichier qui référencera les information, les librairies et les dépendances utilisées dans le projet.
            </p>
            <p>
                Ce fichier est créé à la racine du projet.
            </p>
            <h2>Installer sur le projet</h2>
            <p>
                il faut lancer la commande <code>composer install</code>
            </p>
            <h2>Installer une dépendance</h2>
            <p>
                Composer est un installeur, on va lui demander d'aller chercher la dépendance requise et de l'installer
                dans le projet, on utilisera la commande <code>composer require <nom du paquet></code>.
            </p>
            <p>
                Par exemple, pour installer les collections de doctrine qu'on va utiliser ensuite,
                on entrera la commadne suivante :
            </p>
            <code>
                composer require doctrine/collections
            </code>
            <p>
                on voit ensuite que le fichier <code>composer.json</code> a été mis à jour avec a partie suivante :
            </p>
            <code>
                "require": {<br/>
                &nbsp;&nbsp;"doctrine/collections": "^1.6"<br/>
                }
            </code>
            <p>
                Ici, on n'installera pas tous les paquets de doctrine, c'est pour cela qu'on a précisé que l'on
                choisit <code>doctrine/collections</code>
            </p>
            <h2>Installer d'autres dépendances</h2>
            <p>
                composer utilise le dépôt officiel des packages (paquets) Php :
                <a href="https://packagist.org/" target="_blank">Packagist</a>.
                Vous y trouverez les paquets et la commande pour les installer.
            </p>
            <p>
                On peut aussi installer d'autre dépendances en modifiant le fichier <code>composer.json</code>.
                Après <code>"minimum-stability": "stable"</code>, on ajoute un virgule (on signifie qu'un nouvel attribut
                est ajouté au json) et à la ligne suivante on ajoute :
            </p>
            <code>
                "require": {<br/>
                &nbsp;&nbsp;"doctrine/collections": "^1.6"<br/>
                }
            </code>
            <p>
                Ensuite, il faut lancer une commande pour dire à composer d'aller
                vérifier le fichier <code>composer.json</code> et d'installer les dépendances nouvelles.
            </p>
            <code>
                composer update
            </code>
            <p>
                Utiliser cette méthode permet aussi de choisir la version du package, ici on a choisi la
                dernière version stable, notée <code>"^1.6"</code>
            </p>
            <p>
                on peut gérer les version par plage en utilisant des opérateurs de comparaison :
            </p>
            <ul>
                <li>>=1.0 (version 1 et supérieures)</li>
                <li>>=1.0 <=2.0 (Version supérieire ou égale à 1 et inférieure ou égale à 2)</li>
                <li>>=1.0 <1.1 || >=1.2 (Version supérieire ou égale à 1 et inférieure ou égale à 1.1
                    <b>OU</b> version supérieur ou égal à 1.2)</li>
                <li>1.0 - 2.0 (plage de version qui équivaut à >=1.0.0 <2.1 )</li>
                <li>1.0.* (version 1.0 à inférieur strictement à 1.1)</li>
                <li>~1.4 (version supérieur ou égale à 1.4 mais strictement inférieure à 2.0)</li>
                <li>^1.4.5 (permet les mises à jour mineures suivantes mais pas la mise à jour majeure 2.0)</li>
            </ul>
            <h2>
                require-dev
            </h2>
            <p>
                Composer permet de spécifier les dépendances utilisées pour le développement. on inscrira alors un
                nouvel attribut dans le <code>composer.json</code> nommé <code>require-dev</code>.
            </p>
            <p>
                Pour l'installer en ligne de commande, il faut utiliser <code>composer install</code> et
                <code>composer update</code> en utilisant l'option <code>--no-dev</code> pour préciser en production
                de ne pas installer les dépendances contenues dans <code>require-dev</code>
            </p>
            <p>
                pour le déploiement et les installation en prod, il suffit d'envoyer le code et les fichiers
                composer.json et composer.lock, on ne prends pas les code des dépendances (présentes dans le
                répertoire vendor à la racine). Ensuite on utilise <code>composer install --no-dev</code> pour
                l'installation et <code>composer update --no-dev</code> pour les mises à jour.
            </p>
            <h2>Autoload</h2>
            <p>
                Ce fichier de composer permet de pouvoir charger simplement
                les dépendances installées par composer.
                On peut ajouter avec composer.json nos propres classes.
            </p>
            <code>
                "autoload": {
                    "psr-4:{"App\\": "app/"}
                }
            </code>
            <p>
                <?php
                $test = new Test();
                $test->echoBonjour();
                ?>
            </p>
            <h2>Installation de Bootstrap</h2>
            <p>
                Sur la doc de bootstrap, nous allons utiliser cette commande composer :
            </p>
            <code>
                composer require twbs/bootstrap:4.5.3
            </code>
            <p>
                Ensuite, comme la dépendance c'est téléchargée dans le répertoire "vendor", qui n'est pas visible
                par le public, il faut :
            </p>
            <ol>
                <li>Créer, par exemple, un fichier "assets" à la racine du site</li>
                <li>Y copier ce qui se trouve à l'intérieur du fichier "dist" présent dans
                    <code>vendor/twbs/bootstrap/dist</code>
                </li>
                <li>
                    ensuite faire le lien vers les fichiers requis pour utiliser bootstrap
                </li>
            </ol>
            <p>
                J'ai choisi de faire le lien dans un fichier include que je vais
                appeler à chaque nouvelle page du site
            </p>
        </article>
    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>
