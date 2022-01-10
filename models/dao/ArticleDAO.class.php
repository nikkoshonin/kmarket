<?php

class ArticleDAO extends DAO
{

    /**
     * @param string $tableName
     */
    public function __construct()
    {
        parent::__construct('article');
    }


    public function add(Article $obj)
    {
        try {
            $this->connect();
            $query = "INSERT INTO `article` (`id`, `id_cate`, `titre_art`, `slug_art`, `description_art`, `lien_affiliation_art`, `image_art`) VALUES (NULL, :idCat, :titreArt, :slugArt, :descriptionArt, :lienAffiliationArt, :imageArt)";
            $data = array(
                ':idCat' => $obj->getCategorieId() != 0 ? $obj->getCategorieId() : NULL,
                ':titreArt' => $obj->getTitre(),
                ':slugArt' => $obj->getSlug(),
                ':descriptionArt' => $obj->getContenu(),
                ':lienAffiliationArt' => $obj->getLienAfiliation(),
                ':imageArt' => $obj->getImage(),
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            $this->closeConnexion();
            return $res;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function findBySlug($slug)
    {
        try {
            $this->connect();
            $query = "SELECT * FROM article WHERE slug_art = :slug";
            $data = array(
                ':slug' => $slug
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getArticles($search = "", $categorie = 0)
    {
        try {
            $this->connect();
            $query = "SELECT * FROM article";
            $data = array();
            if ($search != "") {
                $query .= " WHERE titre_art LIKE :titre_art";
                $data[':titre_art']  = '%'.$search.'%';
            }
            if ($categorie > 0) {
                $query .= $search != ""? " AND" : " WHERE";
                $query .= " id_cate = :id_cate";
                $data[':id_cate']  = $categorie;
            }
            $query.= " ORDER BY id desc LIMIT 15";
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function update($obj)
    {
        try {
            $this->connect();
            $query = "UPDATE `article` SET id_cate = :idCat, `titre_art` = :titreArt, `slug_art` = :slugArt, `description_art` = :descriptionArt, `lien_affiliation_art` = :lienAffiliationArt, `image_art` = :imageArt WHERE `id` = :id";
            $data = array(
                ':idCat' => $obj->getCategorieId() != 0 ? $obj->getCategorieId() : NULL,
                ':titreArt' => $obj->getTitre(),
                ':slugArt' => $obj->getSlug(),
                ':descriptionArt' => $obj->getContenu(),
                ':lienAffiliationArt' => $obj->getLienAfiliation(),
                ':imageArt' => $obj->getImage(),
                ':id' => $obj->getId()
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            $this->closeConnexion();
            return $res;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function parseArrayToObjects($articles1)
    {
        $this->tableName = 'categorie';
        $articles = [];
        foreach ($articles1 as $a) {
            $categorie = $a['id_cate'] != 0 ? $this->find($a['id_cate'])['nom_cate'] : '';
            $art = new Article($a['titre_art'], $a['description_art'], $a['slug_art'], new DateTime(date($a['date_art'])), $a['lien_affiliation_art'], $a['image_art'], $a['id_cate'], $categorie);
            $art->setId($a['id']);
            $articles[] = $art;
        }
        $this->tableName = 'article';
        return $articles;
    }
}
