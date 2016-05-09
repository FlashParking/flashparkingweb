<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * Role
 */
class Role
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @var string
     */
    private $description;

 /**
  * @var ArrayCollection|Droit[]
  * @ManyToMany(targetEntity="Droit")
  */
    private $droits;

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
     * @return Role
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
     * @return Role
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
     * Constructor
     */
    public function __construct()
    {
        $this->droits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add droit
     *
     * @param \AppBundle\Entity\Droit $droit
     *
     * @return Role
     */
    public function addDroit(\AppBundle\Entity\Droit $droit)
    {
        $this->droits[] = $droit;

        return $this;
    }

    /**
     * Remove droit
     *
     * @param \AppBundle\Entity\Droit $droit
     */
    public function removeDroit(\AppBundle\Entity\Droit $droit)
    {
        $this->droits->removeElement($droit);
    }

    /**
     * Get droits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDroits()
    {
        return $this->droits;
    }
}
