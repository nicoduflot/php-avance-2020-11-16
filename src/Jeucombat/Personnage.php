<?php


namespace Gam;


class Personnage
{
    //Attributs ou variables
    private $name;
    private $force;
    private $localisation;
    private $experience;
    private $degats;
    private $vigueur;
    private $tabRestauration =["1;10", "11;30", "31;50", "51;70", "71;100"];
    private $arme;
    private $maxDegats;
    private $bonusDegats;
    private $uniqId;

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
     * @return false|float
     */
    public function getBonusDegats()
    {
        return $this->bonusDegats;
    }

    /**
     * @param false|float $bonusDegats
     */
    public function setBonusDegats($bonusDegats): void
    {
        $this->bonusDegats = $bonusDegats;
    }

}
