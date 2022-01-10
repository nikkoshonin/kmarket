<?php

require_once('../models/Article.class.php');
require_once('../models/Categorie.class.php');

class MainController extends Controller
{

    /**
     *
     * @return mixed
     */
    function index()
    {
        // On stocke la liste des articles dans $articles
        $categorieModel = $this->loadModel('CategorieDAO');
        $articleModel = $this->loadModel('ArticleDAO');
        $categories = $categorieModel->parseArrayToObjects($categorieModel->findAll());
        $selectedCategorie = isset($_POST['categorie']) ? intval($_POST['categorie']) : 0;
        $search = isset($_POST['search']) ? strip_tags(trim($_POST['search'])) : "";
        $articles = $articleModel->parseArrayToObjects($articleModel->getArticles($search, $selectedCategorie));
        // On affiche les données
        $this->render(
            'customer/pages/post',
            [
                'articles' => $articles,
                'categories' => $categories,
                'selectedCategorie' => $selectedCategorie,
                'search' => $search
            ]
        );
    }

    function notFound()
    {
        $this->render('404');
    }


    public function login()
    {
        if (!Security::checkAuth()) {

            $message = "";
            if (isset($_POST['submit']) && trim($_POST['username']) != "" && trim($_POST['password']) != "") {

                Security::authenticate($_POST['username'], $_POST['password']);
                if (Security::checkAuth()) {
                    echo json_encode(['success' => true]);
                    die();
                } else {
                    $message = "Identifiants ou mots de passe incorrectes";
                    echo json_encode(['message' => $message, 'success' => false]);
                    die();
                }
            } else
                $this->render('admin/utilisateur/login', ['message' => $message]);
        } else {
            header('Location: /article');
        }
    }


    public static function logout()
    {
        session_start();
        session_destroy();
        header('Location: /main/login');
        exit();
    }
}
