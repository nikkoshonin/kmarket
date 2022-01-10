<?php

require_once('../models/Utilisateur.class.php');

class UtilisateurController extends Controller
{
    private $salt = "bMpPP1@2002U";
    /** */
    public function __construct()
    {
        $this->model = parent::loadModel('UtilisateurDAO');
        $this->viewsPath = "admin/utilisateur/";
    }


    public function index()
    {
        if (Security::checkAuth() && $_SESSION['role'] == cleCryptee(Role::SUPERADMIN)) {
            
            // On stocke la liste des utilisateurs dans $utilisateurs
            $users = $this->model->findAll();

            $utilisateurs = $this->model->parseArrayToObjects($users);
            // On affiche les données
            $this->renderAdminTemplate($this->viewsPath . 'add_list', ['utilisateurs' => $utilisateurs]);
        } else {
            header('Location: /main/login');
        }
    }

    public function create()
    {
        $show = false;
        if (Security::checkAuth() && $_SESSION['role'] == cleCryptee(Role::SUPERADMIN)) {
            //vérification et traitement des valeurs saisies du formulaire.
            if (isset($_POST['submit']) && trim($_POST['username']) != ""  && trim($_POST['email']) != "" && trim($_POST['psswd']) != "") {
                $username = strip_tags(trim($_POST['username']));
                $exist = $this->model->findByUsername($username);
                if ($exist == null) {
                    if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/', $_POST['psswd']) && $_POST['psswd'] == $_POST['psswdR']) {
                        $passwordHash = password_hash($_POST['psswd'] . $this->salt, PASSWORD_BCRYPT);
                        $utilisateur = new Utilisateur($_POST['username'], strip_tags(trim($_POST['email'])), (int)$_POST['etat']);
                        $utilisateur->setPassword($passwordHash);
                        $show = $this->model->add($utilisateur);
                        $this->flashMessageType = $show ? "success" : "danger";
                        $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de l'enregistrement";
                    } else {
                        $this->flashMessageType = "danger";
                        $this->flashMessage = "Mots de passes invalides";
                    }
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Ce nom d'utilisateur est déja pris";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Erreur lors de l'enregistrement, Veuillez bien remplir les champs";
            }
            flash('utilisateur', $this->flashMessage, $this->flashMessageType);
            header('Location: /utilisateur');
        } else {
            header('Location: /main/login');
        }
    }

    public function update()
    {
        if (Security::checkAuth() && $_SESSION['role'] == cleCryptee(Role::SUPERADMIN) && cleCryptee($_POST['id']) == $_POST['cle']) {
            if (isset($_POST['submit']) && trim($_POST['username']) != ""  && trim($_POST['email']) != "" && cleCryptee($_POST['id']) == $_POST['cle']) {
                $user = $this->model->find(intval($_POST['id']));
                $username = strip_tags(trim($_POST['username']));
                if ($user != null) {
                    if ($user['username'] != $username) {
                        $exist = $this->model->findByUsername($username);
                        if ($exist == null)
                            $user['username'] = $username;
                        else {
                            $this->flashMessageType = "danger";
                            $this->flashMessage = "Ce nom d'utilisateur est déjà pris";
                        }
                    }

                    $utilisateur = new Utilisateur($user['username'], strip_tags(trim($_POST['email'])), isset($_POST['etat'])? (int)$_POST['etat'] : $user['etat']);
                    $utilisateur->setId($user['id']);
                    $show = $this->model->update($utilisateur);
                    $this->flashMessageType = $show ? "success" : "danger";
                    $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de l'enregistrement";
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Une erreur s'est produite veuillez reessayer";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Erreur lors de l'enregistrement, Veuillez bien remplir les champs";
            }
            flash('utilisateur', $this->flashMessage, $this->flashMessageType);
            header('Location: /utilisateur');
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
        if (Security::checkAuth() && $_SESSION['role'] == cleCryptee(Role::SUPERADMIN) && cleCryptee($_POST['id']) == $_POST['cle']) {

            if (isset($_POST['submit'])) {
                $ut = $this->model->find(intval($_POST['id']));

                if ($ut != null) {
                    $show = $this->model->delete(intval($ut['id']));
                    $this->flashMessageType = $show ? "success" : "danger";
                    $this->flashMessage = $show ? "Opération effectuée avec success" : "Une erreur s'est produit lors de la suppression";
                } else {
                    $this->flashMessageType = "danger";
                    $this->flashMessage = "Une erreur s'est produite lors de la suppression";
                }
            } else {
                $this->flashMessageType = "danger";
                $this->flashMessage = "Une erreur s'est produite lors de la suppression,reessayez";
            }
            flash('utilisateur', $this->flashMessage, $this->flashMessageType);
            header('Location: /utilisateur');
        } else {
            header('Location: /main/login');
        }
    }
}
