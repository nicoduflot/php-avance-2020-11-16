<?php


namespace Gam;


class Arme
{
    private $nom;
    private $niveauDegats;
    private $tabDegats = ["0;1", "1;5", "6;10", "11;15"];

    /**
     * Arme constructor.
     * @param string $nom
     * @param int $degats
     */
    public function __construct($nom = "Mains nues", $niveauDegats = 0)
    {
        $this->nom = $nom;
        if($niveauDegats > 3){
            $niveauDegats = 3;
        }
        $this->niveauDegats = $niveauDegats;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getNiveauDegats(): int
    {
        $tabMinMax = explode(";", $this->tabDegats[$this->niveauDegats]);
        return random_int(intval($tabMinMax[0]), intval($tabMinMax[1]));
    }

    /**
     * @param int $niveauDegats
     */
    public function setNiveauDegats(int $niveauDegats): void
    {
        if($niveauDegats > 3){
            $niveauDegats = 3;
        }
        $this->niveauDegats = $niveauDegats;
    }

    /**
     * @return string[]
     */
    public function getTabDegats(): array
    {
        return $this->tabDegats;
    }
}
