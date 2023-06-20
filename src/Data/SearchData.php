<?php

namespace App\Data;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class SearchData
{
    /**
     * @var DateTime|null
     * @Assert\GreaterThan("today",
     *     message="La date debut ne doit pas être anterieure à la date d'aujourd'hui ")
     */


    private $debut;
    /**
     * @var DateTime|null
     * @Assert\Type("DateTime")
     * @Assert\Expression("value > this.getDebut()",
     *     message="La date fin ne doit pas être antérieure à la date début")
     *
     */

    private $fin;

    /**
     * @var null|integer
     *
     */
    public $max;

    /**
     * @var null|integer
     */
    public $min;

    private $categorie;

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @param int|null $max
     */
    public function setMax(?int $max): void
    {
        $this->max = $max;
    }

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @param int|null $min
     */
    public function setMin(?int $min): void
    {
        $this->min = $min;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }





    /**
     * @return DateTime|null
     */
    public function getDebut(): ?DateTime
    {
        return $this->debut;
    }

    /**
     * @param DateTime|null $debut
     */
    public function setDebut(?DateTime $debut): void
    {
        $this->debut = $debut;
    }

    /**
     * @return DateTime|null
     */
    public function getFin(): ?DateTime
    {
        return $this->fin;
    }

    /**
     * @param DateTime|null $fin
     */
    public function setFin(?DateTime $fin): void
    {
        $this->fin = $fin;
    }

}