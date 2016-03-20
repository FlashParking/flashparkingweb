<?php

namespace AppBundle\Entity;

/**
 * Ticket
 */
class Ticket
{
    /**
     * @var int
     */
    private $id;

    private $partenaire;
    private $reservation;
    private $code;


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
     * Set partenaire
     *
     * @param \AppBundle\Entity\Partenaire $partenaire
     *
     * @return Ticket
     */
    public function setPartenaire(\AppBundle\Entity\Partenaire $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return \AppBundle\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Set code
     *
     * @param \AppBundle\Entity\QrCode $code
     *
     * @return Ticket
     */
    public function setCode(\AppBundle\Entity\QrCode $code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return \AppBundle\Entity\QrCode
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Ticket
     */
    public function setReservation(\AppBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \AppBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
