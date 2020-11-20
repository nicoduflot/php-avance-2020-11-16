<?php
require "vendor/autoload.php";
use App\MonException;

function multiplier($x, $y){
    if(!is_numeric($x) || !is_numeric($y)){
        throw new Exception("Les deux valeurs doivent être numériques");
    }
    return $x*$y;
}

function multiplier2($x, $y){
    if(!is_numeric($x) || !is_numeric($y)){
        throw new MonException("Les deux valeurs doivent être numériques 2");
    }

    if(func_num_args() > 2 ){
        throw new Exception("Il faut deux arguments pour utiliser cette fonction");
    }

    return $x*$y;
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
        <article class="col-lg-12">
            <h1>Exception Php et Exception PDO</h1>
            <h2>Exception Php</h2>
            <h3>Principes</h3>
            <p>
                Exception est une classe Php qui existe par défaut.
                Pour générer une exception dans un programme, il faut l'appeler à l'intéreur de la fonction a tester.
            </p>
            <code>
                echo multiplier(20, 12);<br />
                echo multiplier("test", 23);<br />
                echo multiplier(113, 42);<br />
            </code>
            <p>
                <?php
                echo multiplier(20, 12)."<br />";
                //echo multiplier("test", 23)."<br />";
                echo multiplier(113, 42)."<br />";
                ?>
            </p>
            <p>
                Si on n'utilise pas de try-catch sur des expression lançant des Exceptions,
                le reste du programme ne continue, ce qui génère des pages incomplètes.
            </p>
            <code>
                try{<br />
                &nbsp;&nbsp;echo multiplier(20, 12);<br />
                &nbsp;echo multiplier("test", 23);<br />
                &nbsp;echo multiplier(113, 42);<br />
                }catch (Exception $e){<br />
                &nbsp;&nbsp;echo "Une Exception a été lancée : <br />Message : ".<br />
                &nbsp;&nbsp;$e->getMessage();<br />
                }
            </code>
            <p>
                <?php
                try{
                    echo multiplier(20, 12)."<br />";
                    echo multiplier("test", 23)."<br />";
                    echo multiplier(113, 42)."<br />";
                }catch (Exception $e){
                    echo "Une Exception a été lancée : <br />Message : ".
                        $e->getMessage()."<br />Ligne : ".$e->getLine().
                        "<br />Code : ".$e->getCode().
                        "<br />File : ".$e->getFile().
                        "<br />Trace as string : ".$e->getTraceAsString().
                        "<br />Previous : ".$e->getPrevious();
                }
                ?>
            </p>
            <p>
                Contrairement au premier exemple, le reste des instructions hors try s'exécute normalement,
                donc le reste de la page s'affiche.
            </p>
            <h3>Surcharger Exception : classe étendue personnelle</h3>
            <p>
                Comme Exception est une classe, il est donc possible de créer sa propre classe étendue d'Exception.
                En surchargeant les méthodes, on peut ne filtrer ou demander que ses propres exception.
                Pour, par exemple, n'avoir que getMessage() au retour d'une exception.
            </p>
            <code>

            </code>
            <p>
                <?php
                try{
                    echo multiplier2(20, 12);
                    echo "<br />";
                    echo multiplier2(113, 45);
                    echo "<br />";
                    echo multiplier2("test", 23)."<br />";
                }
                catch (MonException $e){
                    echo $e;
                }
                catch (Exception $e){
                    echo $e;
                }

                ?>
            </p>
            <h3>Exception dans PDO</h3>
            <p>
                Il existe des exceptions pour PDO, mais elles ne sont pas natives dans Php, il faut
                les installer, il existe des dépendances sur packagist installable avec composer
            </p>
            <code>
                composer require ext-pdo
            </code>
            <p>
                <?php
                try {
                    $bdd = new PDO("mysql:host=localhost;dbname=php-avance;charset=utf-8",
                        "root",
                        "");
                    //$bdd->
                }catch(PDOException $e){
                    echo "La connexion a échoué<br />";
                    echo "Raisons : <br />Code erreur : ".$e->getCode()."<br />";
                    echo "Message : ".$e->getMessage()."<br /> à la ligne ".$e->getLine();
                }
                ?>
            </p>
        </article>
    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>
