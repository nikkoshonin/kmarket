<?php

abstract class DAO
{
    protected $connexion;
    protected $tableName;
    protected $lastID;

    /**
     * @param string $tableName
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    protected function connect()
    {
        $this->closeConnexion();
        try {
            $this->connexion = new PDO("mysql:host=" . PDO_HOST . ";" . "dbname=" . PDO_DBBASE.";charset=utf8", PDO_USER, PDO_PW);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function closeConnexion()
    {
        $this->connexion = null;
    }

    public function find($id)
    {
        try {
            $this->connect();
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
            $data = array(
                ':id' => $id
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function findAll()
    {
        try {
            $this->connect();
            $query = "SELECT * FROM " . $this->tableName;
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public function delete($id)
    {
        try {
            $this->connect();
            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $data = array(
                ':id' => $id
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

    public function getLastId()
    {
        try {
            $this->connect();
            $sql = "SELECT id as LastID from " . $this->tableName . " where id = @@Identity;"; // @@Identity permet de recuperer la dernière valeur entrée
            $stmt = $this->connexion->query($sql);

            while ($id = $stmt->fetch(PDO::FETCH_OBJ)) {
                $this->setLastID($id->LastID);
            }
            $this->closeConnexion();
            return $this->lastID;
        } catch (Exception $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Set the value of lastID
     *
     * @return  self
     */ 
    private function setLastID($lastID)
    {
        $this->lastID = $lastID;

        return $this;
    }
}
