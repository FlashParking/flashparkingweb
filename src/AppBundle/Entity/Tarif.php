<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tarif
 */
class Tarif
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 5,
     *     max = 255
     * )
     */
    private $libelle;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 5,
     *     max = 255
     * )
     */
    private $description;

    /**
     * @var float
     *
     * @Assert\NotBlank
     * @Assert\Type(
     *     message = "Le prix doit être un nombre",
     *     type= "float"
     * )
     */
    private $prix;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Tarif
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tarif
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Tarif
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }
}
