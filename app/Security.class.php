<?php
require_once '../models/dao/UtilisateurDAO.class.php';
class Security
{
    public static function checkAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params(0);
            session_start();
        }
        return isset($_SESSION['auth']);
    }

    public static function authenticate($username, $password)
    {
        $userDao = new UtilisateurDAO();
        $user = $userDao->findByUsername($username);
        if ($user != null && $user['etat'] > 0 && password_verify($password . "bMpPP1@2002U", $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_set_cookie_params(0);
                session_start();
            }
            $_SESSION['auth'] = cleCryptee((int)$user['id']);
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = cleCryptee((int)$user['role']);
        }
    }
}
