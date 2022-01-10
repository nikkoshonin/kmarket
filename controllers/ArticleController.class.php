<?php
require_once('../models/Article.class.php');
require_once('../models/Categorie.class.php');

class ArticleController extends Controller
{
    /**
     */
    function __construct()
    {
        $this->model = parent::loadModel('ArticleDAO');
        $this->viewsPath = "admin/article/";
    }

    /**
     *
     * @return mixed
     */
    function index()
    {
        if (Security::checkAuth()) {
            // On stocke la liste des articles dans $articles
            $articles1 = $this->model->findAll();
            $articles = $this->model->parseArrayToObjects($articles1);
            $categorieModel = $this->loadModel('CategorieDAO');
            $categorie = $categorieModel->findAll();
            $categories = $categorieModel->parseArrayToObjects($categorie);
            // On affiche les données
            $this->renderAdminTemplate($this->viewsPath . 'add_list', ['articles' => $articles, 'categories' => $categories]);
        } else {
            header('Location: /main/login');
        }
    }

    /**
     *
     * @return mixed
     */
    function create()
    {
        $show = false;
        if (Security::checkAuth()) {
            if (isset($_POST['submit']) && trim($_POST['titre']) != "" && trim($_POST['description']) != "" && trim($_POST['lien']) != "" && validUrl(trim($_POST['lien']))) {
                $slug = createSlug(strip_tags($_POST['titre']));
                $exist = $this->model->findBySlug($slug);
                if ($exist == null) {
                    $image = $_FILES['image']['size'] > 0 ? uploadImage() : "";
                    $article = new Article(strip_tags(trim($_POST['titre'])), strip_tags(trim($_POST['description'])), $slug, new DateTime(date('Y-m-d H:i:s')), strip_tags(trim($_POST['lien'])), $image, intval($_POST['categorie']));
                    $show = $this->model->add($article);
                    $this->flashMessageType = $show ? "success" : "danger";
                    $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de l'enregistrement";
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Un produit du même nom existe déja";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Une erreur s'est produite lors de l'enregistrement du produit";
            }
            flash('article', $this->flashMessage, $this->flashMessageType);
            header('Location: /article');
            exit();
        } else {
            header('Location: /main/login');
        }
    }

    /**
     *
     * @return mixed
     */
    function update()
    {
        if (Security::checkAuth()) {
            if (isset($_POST['submit']) && trim($_POST['titre']) != "" && trim($_POST['description']) != "" && trim($_POST['lien']) != "" && validUrl(trim($_POST['lien'])) && cleCryptee($_POST['id']) == $_POST['cle']) {
                $a = $this->model->find(intval($_POST['id']));

                if ($a != null) {
                    $slug = createSlug(strip_tags($_POST['titre']));
                    if ($a['slug_art'] != $slug) {
                        $exist = $this->model->findBySlug($slug);
                        if ($exist == null)
                            $a['slug_art'] = $slug;
                        else {
                            $this->flashMessageType = "danger";
                            $this->flashMessage = "Un produit du même nom existe déja";
                        }
                    }

                    $image = $_FILES['image']['size'] > 0 ? uploadImage() : "";
                    $article = new Article(strip_tags(trim($_POST['titre'])), strip_tags(trim($_POST['description'])), $a['slug_art'], new DateTime(date($a['date_art'])), strip_tags(trim($_POST['lien'])),  $image != "" ? $image : $a['image_art'], intval($_POST['categorie']));
                    $article->setId($a['id']);
                    $show = $this->model->update($article);

                    $this->flashMessageType = $show ? "success" : "danger";
                    $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de l'enregistrement";
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Une erreur s'est produite lors de la modification";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Une erreur s'est produite lors de l'enregistrement du produit";
            }
            flash('article', $this->flashMessage, $this->flashMessageType);
            header('Location: /article');
            exit();
        } else {
            header('Location: /main/login');
        }
    }

    /**
     *
     * @return mixed
     */
    function delete()
    {
        if (Security::checkAuth()) {
            if (isset($_POST['submit']) && cleCryptee($_POST['id']) == $_POST['cle']) {
                $a = $this->model->find(intval($_POST['id']));
                if ($a != null) {
                    $show = $this->model->delete(intval($a['id']));

                    if ($show && $a['image_art'] != "") {
                        $show = unlink($a['image_art']);
                    }
                    $this->flashMessageType = $show ? "success" : "danger";
                    $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de la suppression";
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Une erreur s'est produite lors de la suppression";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Une erreur s'est produite lors de la suppression";
            }
            flash('article', $this->flashMessage, $this->flashMessageType);
            header('Location: /article');
            exit();
        } else {
            header('Location: /main/login');
        }
    }
}
