<h3>Gestion des utilisateurs</h3>
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="d-lg-flex justify-content-between">
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#ajouter">Ajouter</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Settings">Liste des
                                utilisateurs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    flash('utilisateur');
    ?>

</div>
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active show" id="ajouter">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Créer un nouveau compte</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/utilisateur/create">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                                <label class="form-label">Nom d'utilisateur <span style="color: red;">*</span> </label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                                <label class="form-label">Email<span style="color: red;">*</span></label>
                                                <input type="email" class="form-control" id="email" placeholder="josephCollin@gmail.com" name="email" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                                <label class="form-label">Mot de passe <span style="color: red;">*</span></label>
                                                <input type="password" minlength="8" class="form-control" id="password" name="psswd" placeholder="Mot de passe" required>
                                                <small class="text-warning" id="messagePass2" style="font-size: 10px;">Au moins 8 caractères un chiffre, une miniscule, une majuscule et un caractère spécial</small>
                                            </div>

                                            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                                <label class="form-label">Confirmation mot de passe <span style="color: red;">*</span></label>
                                                <input type="password" id="repeatPassword" class="form-control" name="psswdR" placeholder="Mot de passe" required>
                                                <span class="text-danger" id="message_pass">Les mots de passe saisies ne sont pas les mêmes</span><br>
                                            </div>

                                            <?php /*<div class="col-md-4 col-lg-4 col-sm-12">
                                                <label>Role<span class="text-danger">*</span></label>
                                                <select class="form-control show-tick" name="role">
                                                    <option value="">-- Choisissez un Role --</option>
                                                    <option value="utilisateur">utilisateur</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>*/
                                            ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <label class="form-label">Etat<span class="text-danger"> *</span></label>
                                                <select class="form-control show-tick" name="etat">
                                                    <option value="0">Désactivé</option>
                                                    <option value="1" selected>Activé</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 m-t-20 text-right">
                                            <button type="reset" class="btn btn-danger">Annuler</button>
                                            <button type="submit" id="submitButton" name="submit" class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="Settings">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                </div>
                            </div>
                            <div class="card">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm">Nom d'utilisateur
                                            </th>
                                            <th class="th-sm">Email
                                            </th>
                                            <th class="th-sm">Etat
                                            </th>
                                            <th class="th-sm">Role
                                            </th>
                                            <th class="th-sm">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($utilisateurs as $utilisateur) : ?>
                                            <tr>
                                                <td><?= strip_tags($utilisateur->getUsername()) ?></td>
                                                <td><?= strip_tags($utilisateur->getEmail()) ?></td>
                                                <td><?= getEtatValue($utilisateur->getEtat()) ?></td>
                                                <td><?= getRoleValue($utilisateur->getRole()) ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-target="#modificationModal<?= $utilisateur->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-edit" style="color: green;"></i></button>
                                                        <?php if (cleCryptee($utilisateur->getId()) != $_SESSION['auth']) { ?>
                                                            <button data-target="#confirmationModal<?= $utilisateur->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-trash" style="color: red;"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                    <!-- DEBUT Modal modification-->
                                                    <div class="modal fade" id="modificationModal<?= $utilisateur->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Modifier <?= htmlspecialchars($utilisateur->getUsername()) ?>
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Corps formulaire Modal Modification-->

                                                                    <form method="POST" action="utilisateur/update">
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Nom d'utilisateur <span style="color: red;">*</span> </label>
                                                                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($utilisateur->getUsername()) ?>" placeholder="Saisissez votre nom" required>
                                                                            </div>
                                                                            <input name="id" value="<?= $utilisateur->getId() ?>" type="hidden">
                                                                            <input name="cle" type="hidden" value="<?= cleCryptee($utilisateur->getId()) ?>" />
                                                                            <div class="form-group">
                                                                                <label class="form-label">Email<span style="color: red;">*</span></label>
                                                                                <input type="email" class="form-control" value="<?= htmlspecialchars($utilisateur->getEmail()) ?>" placeholder="josephCollin@gmail.com" name="email" required>
                                                                            </div>
                                                                            <?php if (cleCryptee($utilisateur->getId()) != $_SESSION['auth']) { ?>

                                                                                <div class="row">
                                                                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                                                                        <label class="form-label">Etat<span class="text-danger"> *</span></label>
                                                                                        <select class="form-control show-tick" name="etat">
                                                                                            <option value="1" <?= $utilisateur->getEtat() == 1 ?  'selected = "selected"' : "" ?>>Activé</option>
                                                                                            <option value="0" <?= $utilisateur->getEtat() == 0 ?  'selected = "selected"' : "" ?>>Désactivé</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Fin Modal modification-->
                                                    </div>


                                                    <!-- debut Modal SUppression-->
                                                    <div class="modal fade" id="confirmationModal<?= $utilisateur->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Supprimer <?= htmlspecialchars($utilisateur->getUsername()) ?>
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Etes-vous sur de vouloir supprimer?

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="utilisateur/delete" method="post">
                                                                        <input type="hidden" name="id" value="<?= $utilisateur->getId() ?>">
                                                                        <input name="cle" type="hidden" value="<?= cleCryptee($utilisateur->getId()) ?>" />
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
                                                                        <button class="btn btn-danger" type="submit" name="submit">oui</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fin Modal suppression-->
                                                </td>
                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>