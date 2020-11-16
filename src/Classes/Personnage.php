<?php

namespace App;

class Personnage
{
    //Attributs ou variables
    private $name;
    private $force;
    private $localisation;
    private $experience;
    private $degats;
    private $arme;
    private $vigueur;
    private $tabRestauration =["1;10", "11;30", "31;50", "51;70", "71;100"];

    /**
     * Personnage constructor.
     * @param string $name
     * @param int $force
     * @param int $degats
     */
    public function __construct($name, $force, $degats, Arme $arme)
    {
        $this->setName($name);
        $this->setForce($force);
        $this->localisation ="Entrée du donjon";
        $this->experience = 1;
        $this->setDegats($degats);
        $this->arme = $arme;
        $this->vigueur = $this->getForce();
    }

    //méthodes de Personnage

    public function frapper(Personnage $persoCible){
        $vigueurFrappe = $this->vigueur;
        //$persoCible->degats += $this->force;
        $degatsFrappe =$this->arme->getNiveauDegats();
        $persoCible->setDegats($persoCible->getDegats()+$this->vigueur+$degatsFrappe);
        //dégâts de perso2 reçoit dégâts existant + force perso1 + dégâts de l'arme perso1

        echo $this->name." occasionne ".$degatsFrappe." dégât(s)<br />";

        if($this->vigueur>0){
            $this->setVigueur($vigueurFrappe-1);
        }
    }

    public function gagnerExperience(){
        $this->experience++;
    }

    public function seDeplacer($nouvelleSalle){
        $this->localisation = $nouvelleSalle;
    }

    public function seRestaurer($niveauRestauration){

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

    //getters & setters
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        if(!is_string($name)){
            trigger_error("Le nom doit être une chaîne de caractères", E_USER_WARNING);
        }
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getForce()
    {
        return $this->force;
    }


    /**
     * @param int $force
     */
    public function setForce($force)
    {
        if(!is_int($force)){
            trigger_error("La force doit être un nombre entier", E_USER_WARNING);
        }
        $this->force = $force;
    }

    /**
     * @return mixed
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param mixed $localisation
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return int
     */
    public function getDegats()
    {
        return $this->degats;
    }

    /**
     * @param int $degats
     */
    public function setDegats($degats)
    {
        if(!is_int($degats)){
            trigger_error("Les dégâts doivent être un nombre entier", E_USER_WARNING);
        }
        $this->degats = $degats;
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


}
