<h3>Gestion des catégories</h3>
<div class="section-body">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="d-lg-flex justify-content-between">
          <ul class="nav nav-tabs page-header-tab">
            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#ajouter">Ajouter</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Email_Settings">Liste categories</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php
  flash('categorie');
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
                <h3 class="card-title">Ajout d'une categorie</h3>
                <div class="card-options">
                  <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                  <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                  <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
              </div>
              <div class="card-body">
                <form action="/categorie/create" method="POST">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label class="form-label">Nom<span class="text-danger"> *</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nom" type="text" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <button type="reset" class="btn btn-danger">Annuler</button>
                      <button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="Email_Settings">
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
                      <th class="th-sm">Nom
                      </th>
                      <th class="th-sm">Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($categories as $c) : ?>
                      <tr>
                        <td><?= htmlspecialchars($c->getNom()) ?></td>
                        <td>

                          <div class="btn-group">
                            <button data-target="#modificationModal<?= $c->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-edit" style="color: green;"></i></button>
                            <button data-target="#confirmationModal<?= $c->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-trash" style="color: red;"></i></button>
                          </div>

                          <div class="modal fade" id="modificationModal<?= $c->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="ModificationModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalSuppression">Modifier <?= htmlspecialchars($c->getNom()) ?>
                                  </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <!-- Corps formulaire Modal Modification-->
                                  <form action="/categorie/update" method="POST">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($c->getId()) ?>">
                                    <input name="cle" type="hidden" value="<?= cleCryptee($c->getId()) ?>" />
                                    <div class="row">
                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label class="form-label">Nom *</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="icon-envelope"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($c->getNom()) ?>" type="text" name="nom">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-danger">Annuler</button>
                                      <button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Fin Modal modification-->
                          </div>


                          <!-- debut Modal SUppression-->
                          <div class="modal fade" id="confirmationModal<?= $c->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalSuppression">Supprimer <?= htmlspecialchars($c->getNom()) ?>
                                  </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Etes-vous sur de vouloir supprimer?<br>
                                  <b class="text-danger">Tous les produits de cette catégories seront automatiquement supprimés.</b>
                                </div>
                                <div class="modal-footer">
                                  <form action="/categorie/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $c->getId() ?>">
                                    <input name="cle" type="hidden" value="<?= cleCryptee($c->getId()) ?>" />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <button class="btn btn-danger" type="submit" name="submit">Oui</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                        </td>
                      </tr>
                    <?php endforeach ?>
                    <!-- DEBUT Modal modification-->
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