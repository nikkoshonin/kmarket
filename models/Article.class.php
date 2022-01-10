<?php

class Article {
    private $id;
    private $titre;
    private $contenu;
    private $slug;
    private $datePublication;
    private $dateModification;
    private $lienAfiliation;
    private $image;
    private $categorieId;
    private $categorieNom;

    /**
     * @param string $titre
     * @param string $contenu
     * @param string $slug
     * @param DateTime $datePublication
     * @param DateTime $dateModification
     * @param string $lienAfiliation
     * @param string $image
     * @param int $categorieId
     */
    public function __construct($titre, $contenu, $slug, $datePublication,$lienAfiliation, $image, $categorieId = 0, $categorieNom = "")
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->slug = $slug;
        $this->datePublication = $datePublication;
        $this->lienAfiliation = $lienAfiliation;
        $this->image = $image;
        //$this->dateModification = $dateModification;
        $this->categorieId = $categorieId;
        $this->categorieNom = $categorieNom;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCategorieId()
    {
        return $this->categorieId;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param string $datePublication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }

    /**
     * @return string
     */
    public function getLienAfiliation()
    {
        return $this->lienAfiliation;
    }

    /**
     * @param string $lienAfiliation
     */
    public function setLienAfiliation($lienAfiliation)
    {
        $this->lienAfiliation = $lienAfiliation;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @param DateTime $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }


    /**
     * @param int $categorieId
     */
    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategorieNom()
    {
        return $this->categorieNom;
    }

    /**
     * @param string $categorieNom
     */
    public function setCategorieNom($categorieNom)
    {
        $this->contenu = $categorieNom;
    }
}