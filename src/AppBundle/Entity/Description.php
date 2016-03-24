<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Description
{
    private $id;

    private $description_accueil;


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
        return $this->description_accueil;
    }


    public function setDescriptionAccueil($description_accueil)
    {
        $this->description_accueil = $description_accueil;
    }


}