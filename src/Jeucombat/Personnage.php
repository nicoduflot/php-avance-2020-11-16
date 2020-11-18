<?php


namespace Gam;


class Personnage
{
    //Attributs ou variables
    protected $name;
    protected $force;
    private $localisation;
    protected $experience;
    private $degats;
    private $vigueur;
    private $tabRestauration =["1;10", "11;30", "31;50", "51;70", "71;100"];
    protected $arme;
    private $maxDegats;
    protected $bonusDegats;
    private $uniqId;

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

}
