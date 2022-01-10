<?php
    class UtilisateurDAO extends DAO{

    /**
     * @param string $utilisateur
     */
    public function __construct()
    {
        parent::__construct('utilisateur');
    }


    public function add(Utilisateur $obj)
    {
        try {
            $this->connect();
            $query = "INSERT INTO `utilisateur`(`id`, `username`, `email`, `password`, `role`, `etat`) VALUES (null ,:username,:email,:password,:role,:etat)";
            $data = array(
                ':username' => $obj->getUsername(),
                ':email' => $obj->getEmail(),
                ':password' => $obj->getPassword(),
                ':role' => $obj->getRole(),
                ':etat' => $obj->getEtat()
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
    
    public function update($obj)
    {
        try {
            $this->connect();
            $query = "UPDATE `utilisateur` SET `username` = :username, `email` = :email,  `role` = :role, `etat` = :etat WHERE `id` = :id";
            $data = array(
                ':username' => $obj->getUsername(),
                ':email' => $obj->getEmail(),
                ':role' => $obj->getRole(),
                ':etat' => $obj->getEtat(),
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

    public function findByUsername($username) {
        try {
            $this->connect();
            $query = "SELECT * FROM utilisateur WHERE username = :username";
            $data = array(
                ':username' => $username
            );
            $sth = $this->connexion->prepare($query);
            $res = $sth->execute($data);
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public function parseArrayToObjects($users) {
        $utilisateurs = [];
        foreach ($users as $user) {
            $ut = new Utilisateur($user['username'] ,$user['email'],$user['etat'], $user['role']);
            $ut->setId($user['id']);
            $utilisateurs [] = $ut;
        }
        return $utilisateurs;
    }

}