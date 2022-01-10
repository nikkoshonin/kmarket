<?php
require_once 'utils.php';
abstract class Controller
{
    protected $model;
    protected $viewsPath;
    protected $flashMessage;
    protected $flashMessageType;

    abstract function index();
    /**
     * Permet de charger un modèle
     *
     * @param string $model
     * @return void
     */

    protected function loadModel(string $model)
    {
        // On va chercher le fichier correspondant au modèle souhaité
        require_once(ROOT . '../models/dao/' . $model . '.class.php');
        // On crée une instance de ce modèle. Ainsi "Article" sera accessible par $this->Article
        return new $model();
    }

    /**
     * Afficher une vue
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render(string $fichier, array $data = [])
    {
        // Récupère les données et les extrait sous forme de variables
        extract($data);
        // Crée le chemin et inclut le fichier de vue
        require_once(ROOT . '../views/' . $fichier . '.php');
    }

    /**
     * Afficher une vue
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function renderAdminTemplate(string $fichier, array $data = [])
    {
        // Récupère les données et les extrait sous forme de variables
        extract($data);
        ob_start(); 
        // Crée le chemin et inclut le fichier de vue
        require_once(ROOT . '../views/' . $fichier . '.php');
        $content = ob_get_clean();
        require_once(ROOT.'../views/admin/layout/default.php');
    }
}
