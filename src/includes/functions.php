<?php

use Gam\Personnage;
use Gam\Arme;
use Gam\Mage;
use Gam\Guerrier;

function createPerso($classePerso, $nomPerso, $nomArme, $niveauArme){
    switch ($classePerso){
        case "Personnage":
            $perso = new Personnage($nomPerso, new Arme($nomArme, $niveauArme));
            break;
        case "Mage":
            $perso = new Mage($nomPerso, new Arme($nomArme, $niveauArme));
            break;
        case "Guerrier":
            $perso = new Guerrier($nomPerso, new Arme($nomArme, $niveauArme));
            break;
        default:
            $perso = new Personnage($nomPerso, new Arme($nomArme, $niveauArme));
            $classePerso = "Personnage";
    }
    return $perso;
}
