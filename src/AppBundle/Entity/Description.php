<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Description
{
    private $id;

    private $descriptionAccueil;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getDescriptionAccueil()
    {
        return $this->descriptionAccueil;
    }


    public function setDescriptionAccueil($descriptionAccueil)
    {
        $this->descriptionAccueil = $descriptionAccueil;
    }


}