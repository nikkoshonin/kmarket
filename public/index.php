<?php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
require_once(ROOT . '../config.php');
require_once(ROOT . '../models/dao/DAO.class.php');
require_once(ROOT . '../app/Security.class.php');
require_once(ROOT . '../app/Controller.class.php');

require_once(ROOT . '../controllers/MainController.class.php');

if (isset($_GET['c']) && trim($_GET['c']) != "") {
    if (file_exists(ROOT . '../controllers/' . $_GET['c'] . 'Controller.class.php')) {
        $controller = ucfirst($_GET['c']) . 'Controller';
        $action = isset($_GET['a']) && $_GET['a'] != "" ? $_GET['a'] : 'index';

        require_once(ROOT . '../controllers/' . $controller . '.class.php'
        );
        // On instancie le contrôleur
        $controller = new $controller();
        if (method_exists($controller, $action)) {
            // On appelle la méthode
            $controller->$action();
        } else {
            // On envoie le code réponse 404
            notFound();
        }
    } else {
        notFound();
    }
} else {
    $controller = new MainController();
    $controller->index();
}

function notFound()
{
    $controller = new MainController();
    $controller->notFound();
}
