<?php


namespace Gam;


class Personnage
{
    //Attributs ou variables
    protected $name;
    private $uniqId;
    protected $force;
    protected $vigueur;
    private $maxDegats;
    private $localisation;
    protected $experience;
    private $degats;
    protected $arme;
    protected $bonusDegats;
    protected $mana;
    protected $furie;
    protected $tabRestauration =["1;10", "11;30", "31;50", "51;70", "71;100"];

    //constructeur
    /**
     * Personnage constructor.
     * @param $name
     * @param $force
     */
    public function __construct($name, Arme $arme)
    {
        $this->name = $name;
        $this->force = random_int(20, 40);
        $this->arme = $arme;
        $this->localisation = "Entrée du Donjon";
        $this->experience = 0;
        $this->degats = 0;
        $this->vigueur = $this->force;
        $this->maxDegats = random_int(100, 200);
        $this->bonusDegats = ceil($this->force/5);
        $this->uniqId = strval(date_timestamp_get(new \DateTime())).$this->name;
        $this->mana = random_int(10, 40);
        $this->furie = ceil($this->force/2);
    }

    //méthodes de Personnage

    public function frapper(Personnage $persoCible){
        echo $this->name." frappe ".$persoCible->getName()."<br />";
        $degatsFrappe = $this->arme->getNiveauDegats()+$this->bonusDegats;
        $persoCible->setDegats($persoCible->getDegats()+$degatsFrappe);
        echo $this->name." a fait subir ".$degatsFrappe." dégâts<br />";
        echo $persoCible->getName()." a ".$persoCible->getDegats()." dégâts au total<br />";
        $this->gagnerExperience();
        echo $this->name." a maintenant ".$this->getExperience()." point(s) d'expérience<br />";
    }

    public function checkVitality(Personnage $persoCible){
        if($persoCible->maxDegats <= $persoCible->getDegats()){
            echo $persoCible->getName()." est hors de combat<br />";
            echo "max dégâts : ".$persoCible->getMaxDegats()." dégâts subis : ".$persoCible->getDegats()."<br />";
            return false;
        }else{
            return true;
        }
    }

    public function gagnerExperience(){
        $this->experience++;
    }

    public function seDeplacer($nouvelleSalle){
        $this->localisation = $nouvelleSalle;
    }

    public function seRestaurer($niveauRestauration){
        echo "<h3>".$this->name." Prend une potion de vigueur</h3>";
        if($niveauRestauration > 4){
            $niveauRestauration = 4;
        }
        $tabMinMax = explode(";", $this->tabRestauration[$niveauRestauration]);
        $restauration = random_int(intval($tabMinMax[0]), intval($tabMinMax[1]));
        echo "La potion restaure ".$restauration." points de vigueur<br />";
        if(($restauration+$this->vigueur) > $this->force){
            $restauration = $this->force;
        }else{
            $restauration = $restauration+$this->vigueur;
        }
        echo "pour un maximum de ".$restauration." points de vigueur<br />";
        $this->setVigueur($restauration);
    }

    public function multi(Personnage $persoCible){
        //une attaque brutale consomme 5 points de furie
        if($this->furie - 5 < 0){
            echo "<h3 style='background-color: #ba8b00;color: #fff;font-weight: bold;padding:2px;'>".
                $this->getName()." n'a pas assez de furie pour lancer \"Frappe FORT\"</h3>";
        }else{
            echo "<h3>".$this->getName()." lance \"Frappe FORT\"</h3>".
                "<div style='background-color: #ba8b00;color: #fff;font-weight: bold;padding:2px;'>";

            $tempDegat = $this->getBonusDegats();
            $this->setBonusDegats($tempDegat*2);
            echo "les bonus dégâts passent de ".$tempDegat. " à ".$this->getBonusDegats()."<br />";
            $this->frapper($persoCible);
            $this->setBonusDegats($tempDegat);
            echo "Fin de \"Frappe FORT\" les bonus dégâts sont revenus à ".
                $this->getBonusDegats()."<br />";

            echo "</div>";
            $this>$this->setFurie($this->furie - 5);
        }
    }

    //gettesr & setters
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getForce(): int
    {
        return $this->force;
    }

    /**
     * @param int $force
     */
    public function setForce(int $force): void
    {
        $this->force = $force;
    }

    /**
     * @return Arme
     */
    public function getArme(): Arme
    {
        return $this->arme;
    }

    /**
     * @param Arme $arme
     */
    public function setArme(Arme $arme): void
    {
        $this->arme = $arme;
    }

    /**
     * @return string
     */
    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    /**
     * @param string $localisation
     */
    public function setLocalisation(string $localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     */
    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return int
     */
    public function getDegats(): int
    {
        return $this->degats;
    }

    /**
     * @param int $degats
     */
    public function setDegats(int $degats): void
    {
        $this->degats = $degats;
    }

    /**
     * @return int
     */
    public function getVigueur(): int
    {
        return $this->vigueur;
    }

    /**
     * @param int $vigueur
     */
    public function setVigueur(int $vigueur): void
    {
        $this->vigueur = $vigueur;
    }

    /**
     * @return string[]
     */
    public function getTabRestauration(): array
    {
        return $this->tabRestauration;
    }

    /**
     * @return int
     */
    public function getMaxDegats(): int
    {
        return $this->maxDegats;
    }

    /**
     * @param int $maxDegats
     */
    public function setMaxDegats(int $maxDegats): void
    {
        $this->maxDegats = $maxDegats;
    }

    /**
     * @return int
     */
    public function getBonusDegats()
    {
        return $this->bonusDegats;
    }

    /**
     * @param int $bonusDegats
     */
    public function setBonusDegats(int $bonusDegats): void
    {
        $this->bonusDegats = $bonusDegats;
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

    //getters setters
    /**
     * @return int
     */
    public function getFurie(): int
    {
        return $this->furie;
    }

    /**
     * @param int $furie
     */
    public function setFurie(int $furie): void
    {
        $this->furie = $furie;
    }

    /**
     * @return string
     */
    public function getUniqId(): string
    {
        return $this->uniqId;
    }

    /**
     * @param string $uniqId
     */
    public function setUniqId(string $uniqId): void
    {
        $this->uniqId = $uniqId;
    }
}
