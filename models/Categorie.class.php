<?php

class Categorie {
    private $id;
    private $nom;

    /**
     * @param string $nom
     * @param Utilisateur $utilisateur
     */
    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getnom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setnom($nom)
    {
        $this->nom = $nom;
    }

}