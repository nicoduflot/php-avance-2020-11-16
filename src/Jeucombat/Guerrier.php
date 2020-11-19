<?php


namespace Gam;


class Guerrier extends Personnage
{

    //
    /**
     * Guerrier constructor.
     */
    public function __construct($name, Arme $arme)
    {
        parent::__construct($name, $arme);

    }

    //methodes de guerrier
    public function attaqueBrutale(Personnage $persoCible){
        //une attaque brutale consomme 5 points de furie
        if($this->furie - 5 < 0){
            echo "<h3 style='background-color: #ba8b00;color: #fff;font-weight: bold;padding:2px;'>".
                $this->getName()." n'a pas assez de furie pour lancer une attaque brutale</h3>";
        }else{
            echo "<h3>".$this->getName()." lance une Attaque Brutale</h3>".
                "<div style='background-color: #ba8b00;color: #fff;font-weight: bold;padding:2px;'>";

            $tempDegat = $this->getBonusDegats();
            $this->setBonusDegats($tempDegat*2);
            echo "les bonus dégâts passent de ".$tempDegat. " à ".$this->getBonusDegats()."<br />";
            $this->frapper($persoCible);
            $this->frapper($persoCible);
            $this->setBonusDegats($tempDegat);
            echo "Fin de l'attaque brutale les bonus dégâts sont revenus à ".
                $this->getBonusDegats()."<br />";

            echo "</div>";
            $this>$this->setFurie($this->furie - 5);
        }
    }
}
