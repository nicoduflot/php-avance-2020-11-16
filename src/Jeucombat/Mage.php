<?php


namespace Gam;


class Mage extends Personnage
{

    private $mana;
    //constructeur
    public function __construct($name, Arme $arme)
    {
        parent::__construct($name, $arme);
        $this->mana = random_int(10, 40);
    }
    //methodes
    public function gagnerExperience()
    {
        $this->experience = $this->experience + 2;
    }

    public function bouleDeFeu(Personnage $persoCible){
        //une boule de feu consomme 10 mana
        if($this->mana - 10 < 0){
            echo "<h3 style='background-color: #ff0000;color: #fff;font-weight: bold;padding:2px;'>".
                $this->getName()." n'a pas assez de mana pour lancer une boule de feu</h3>";
        }else{
            $degatBDF = random_int(5, 10);
            echo $this->getName()." lance une boule de feu ".
                "<div style='background-color: #ff0000;color: #fff;font-weight: bold;padding:2px;'>";
            $this->setMana($this->mana - 10);
            $persoCible->setDegats($persoCible->getDegats()+$degatBDF);
            echo "La boule de feu occasionne ".$degatBDF." dégâts sur ".$persoCible->getName()."<br />";
            echo $persoCible->getName()." a ".$persoCible->getDegats()." dégâts au total<br />";
            $this->gagnerExperience();
            echo $this->getName()." a maintenant ".$this->getExperience()." point(s) d'expérience<br />";
            echo "</div>";
        }
    }


    //getters setters
    /**
     * @return int
     */
    public function getMana(): int
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     */
    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }
}
