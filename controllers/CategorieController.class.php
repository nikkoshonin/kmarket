<?php
require_once('../models/Categorie.class.php');

class CategorieController extends Controller
{
    /** */
    public function __construct()
    {
        $this->model = parent::loadModel('CategorieDAO');
        $this->viewsPath = "admin/categorie/";
    }

    public function index()
    {
        if (Security::checkAuth()) {
            $categorie = $this->model->findAll();

            $categories = $this->model->parseArrayToObjects($categorie);
            // On affiche les données
            $this->renderAdminTemplate($this->viewsPath . 'add_list', ['categories' => $categories]);
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
            if (isset($_POST['submit']) && trim($_POST['nom']) != "") {
                $categorie = new Categorie(strip_tags(trim($_POST['nom'])));
                $show = $this->model->add($categorie);
                $this->flashMessageType = $show ? "success" : "danger";
                $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de l'enregistrement";
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Une erreur s'est produite lors de l'enregistrement de la categorie";
            }
            flash('categorie', $this->flashMessage, $this->flashMessageType);
            header('Location: /categorie');
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
            if (isset($_POST['submit']) && trim($_POST['nom']) != "" && cleCryptee($_POST['id']) == $_POST['cle']) {
                $a = $this->model->find(intval($_POST['id']));
                if ($a != null && $a['nom_cate'] != strip_tags(trim($_POST['nom']))) {
                    $categorie = new Categorie(strip_tags(trim($_POST['nom'])));
                    $categorie->setId($a['id']);
                    $show = $this->model->update($categorie);

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
            flash('categorie', $this->flashMessage, $this->flashMessageType);
            header('Location: /categorie');
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
            flash('categorie', $this->flashMessage, $this->flashMessageType);
            header('Location: /categorie');
            exit();
        } else {
            header('Location: /main/login');
        }
    }
}
