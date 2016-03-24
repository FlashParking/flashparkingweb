<?php

namespace AppBundle\Entity;

/**
 * LigneFacturation
 */
class LigneFacturation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantite;

    private $tarif;
    private $facturation;


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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneFacturation
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set tarif
     *
     * @param \AppBundle\Entity\Tarif $tarif
     *
     * @return LigneFacturation
     */
    public function setTarif(\AppBundle\Entity\Tarif $tarif = null)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return \AppBundle\Entity\Tarif
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set facturation
     *
     * @param \AppBundle\Entity\Facturation $facturation
     *
     * @return LigneFacturation
     */
    public function setFacturation(\AppBundle\Entity\Facturation $facturation = null)
    {
        $this->facturation = $facturation;

        return $this;
    }

    /**
     * Get facturation
     *
     * @return \AppBundle\Entity\Facturation
     */
    public function getFacturation()
    {
        return $this->facturation;
    }
}
