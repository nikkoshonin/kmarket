<?php

class CategorieDAO extends DAO
{

    /**
     * @param string $categorie
     */
    public function __construct()
    {
        parent::__construct('categorie');
    }


    public function add(Categorie $obj)
    {
            try {
                $this->connect();
                $query = "INSERT INTO `categorie` (`id`, `nom_cate`) VALUES (NULL, :nomCat)";
                $data = array(
                    ':nomCat' => $obj->getnom(),
                );
                $sth = $this->connexion->prepare($query);
                $res = $sth->execute($data);
                $this->closeConnexion();
                return $res;
            } catch (PDOException $e) {
                print "Erreur!: " . $e->getMessage() . "<br/>";
                die();
            }
    }

    public function update($obj)
    {
        try {
            $this->connect();
            $query = "UPDATE `categorie`SET `nom_cate` = :nomCat WHERE id = :id";
            $data = array(
                ':nomCat' => $obj->getnom(),
                ':id' => $obj->getId()
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            $this->closeConnexion();
            return $res;
        } catch (PDOException $e) {
            print "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function parseArrayToObjects($categories1) {
        $categories = [];
        foreach ($categories1 as $c) {
            $ct = new Categorie($c['nom_cate']);
            $ct->setId($c['id']);
            $categories [] = $ct;
        }
        return $categories;
    }
}
