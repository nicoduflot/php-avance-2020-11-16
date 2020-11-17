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
            <article class="col-lg-12">
                <h1>Collections</h1>
                <h2>Principes</h2>
                <p>
                    Les collections permettent de créer des collections de tableaux
                </p>
                <code>
                    $collection = new ArrayCollection();<br />
                    $collection->add("Nicolas Duflot");
                </code>
                <?php
                // On peut appeler la collection créé par composer ainsi :
                // $collection = new Doctrine\Common\Collection\ArrayCollection();
                // mais onpréfèrera utiliser use
                $collection = new ArrayCollection();
                $collection->add("Nicolas Duflot");
                ?>
                <pre>
                    <?php
                    print_r($collection);
                    ?>
                </pre>
                <?php
                $collection->add("Victor Timmerman");
                $collection->add("Fabien Laurent");
                $collection->add("Nélida Otan");
                ?>
                <pre>
                    <?php
                    print_r($collection);
                    ?>
                </pre>
                <?php
                echo $collection->count()."<br />";
                echo $collection->key()."<br />";
                $collection->clear();
                ?>
                <pre>
                    <?php
                    print_r($collection);
                    ?>
                </pre>
                <?php
                $collection->add("Victor Timmerman");
                $collection->add("Fabien Laurent");
                $collection->add("Nélida Otan");
                $contains = $collection->contains("Victor Timmerman");
                echo "<br />".$contains."<br />";
                $collection->removeElement("Fabien Laurent");
                ?>
                <pre>
                    <?php
                    print_r($collection);
                    echo "les clefs: <br />";
                    for($i = 0; $i < 3;$i++){
                        print_r($collection->key());
                        echo ";";
                        $collection->next();
                    }
                    ?>
                </pre>
                <?php
                $collection2 = new ArrayCollection([1,2,3,4,5,6]);
                $filteredCollection = $collection2->filter(function($element) {
                    return $element > 3;
                });
                echo "<pre>";
                print_r($collection2);
                echo "<br />";
                print_r($filteredCollection);
                echo "</pre>";
                ?>
                <pre>
                    <?php
                    for($i = 0; $i < 3;$i++){
                        print_r($filteredCollection->key());
                        echo ";";
                        $filteredCollection->next();
                    }
                    ?>
                </pre>
                <?php
                $collection3 = new ArrayCollection(['test']);
                $collection3->add("magicien");
                $contains = $collection3->contains('magicien'); // true
                echo $contains;
                ?>
            </article>
        </section>
    </main>
    </body>
</html>
