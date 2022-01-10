<h3>Gestion des produits</h3>
<div class="section-body">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="d-lg-flex justify-content-between">
          <ul class="nav nav-tabs page-header-tab">
            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#ajouter">Ajouter</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Email_Settings">Liste des
                produits</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php
  flash('article');
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
                <h3 class="card-title">Ajout d'un produit</h3>
                <div class="card-options">
                  <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" action="article/create" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope"></i></span>
                          </div>
                          <input type="text" class="form-control" name="titre" type="text" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <label class="form-label">Catégorie<span class="text-danger"></span></label>
                      <select class="form-control show-tick" name="categorie">
                        <option value="0">-- Choisissez une catégorie --</option>
                        <?php foreach ($categories as $categorie) : ?>
                          <option value="<?= $categorie->getId() ?>"><?= strip_tags($categorie->getNom()) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label class="form-label">Lien d'affiliation<span class="text-danger"> *</span></label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-globe"></i></span>
                          </div>
                          <input type="url" class="form-control" name="lien" placeholder="http://" required>
                        </div>
                      </div>

                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="form-label">Description<span class="text-danger"> *</span></label>
                        <textarea class="form-control" placeholder="Description du produit ici" aria-label="With textarea" name="description" required></textarea>
                      </div>
                    </div>
                    <input type="file" class="dropify" accept="image/png, image/gif, image/jpeg" name="image">
                    <small class="text-danger">taille d'image recommandée 200px
                      x 40px</small>
                    <div class="col-sm-12 m-t-20 text-right">
                      <button type="reset" class="btn btn-danger">ANNULER</button>
                      <button type="submit" name="submit" class="btn btn-success">AJOUTER</button>
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
                      <th class="th-sm">Titre
                      </th>
                      <th class="th-sm">Catégorie
                      </th>
                      <th class="th-sm">Lien d'affilation
                      </th>
                      <th class="th-sm">Description
                      </th>
                      <th class="th-sm">publication
                      </th>
                      <th class="th-sm">Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($articles as $article) : ?>
                      <tr>
                        <td><?= htmlspecialchars($article->getTitre()) ?></td>
                        <td><?= htmlspecialchars($article->getCategorieNom()) ?></td>
                        <td><?= $article->getLienAfiliation() ?></td>
                        <td><?= htmlspecialchars($article->getContenu()) ?></td>
                        <td><?= $article->getDatePublication()->format('d/m/y H:i:s') ?></td>
                        <td>
                          <div class="btn-group">
                            <button data-target="#modificationModal<?= $article->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-edit" style="color: green;"></i></button>
                            <button data-target="#confirmationModal<?= $article->getId() ?>" type="button" class="btn" data-toggle="modal"><i class="fa fa-trash" style="color: red;"></i></button>
                            <a href="<?= $article->getImage() ?>" target="_blank" class="btn"><i class="fa fa-eye" style="color: blue;"></i></a>
                          </div>
                          <!-- DEBUT Modal modification-->
                          <div class="modal fade" id="modificationModal<?= $article->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Modifier <?= htmlspecialchars($article->getTitre()) ?>
                                  </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <!-- Corps formulaire Modal Modification-->

                                  <form method="POST" action="/article/update" enctype="multipart/form-data">
                                    <div class="row">
                                      <input type="hidden" name="id" value="<?= $article->getId() ?>">
                                      <input name="cle" type="hidden" value="<?= cleCryptee($article->getId()) ?>" />
                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label class="form-label">Titre *</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="icon-envelope"></i></span>
                                            </div>
                                            <input type="text" class="form-control" required value="<?= htmlspecialchars($article->getTitre()) ?>" name="titre" type="text">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Catégorie</label>
                                        <select class="form-control show-tick" name="categorie">
                                          <option value="0">-- Choisissez une catégorie --</option>
                                          <?php foreach ($categories as $categorie) : ?>
                                            <option value="<?= $categorie->getId() ?>" <?= $categorie->getId() == $article->getCategorieId() ?  'selected = "selected"' : ""?> ><?= strip_tags($categorie->getNom()) ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                      <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                          <label class="form-label">Lien d'affiliation *</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="icon-globe"></i></span>
                                            </div>
                                            <input type="url" class="form-control" required name="lien" value="<?= htmlspecialchars($article->getLienAfiliation()) ?>" placeholder="http://">
                                          </div>
                                        </div>

                                      </div>

                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label class="form-label">Description *</label>
                                          <textarea class="form-control" required placeholder="description du produit ici" aria-label="With textarea" name="description"><?= htmlspecialchars($article->getContenu()) ?></textarea>
                                        </div>
                                      </div>

                                      <input type="file" class="dropify" accept="image/png, image/gif, image/jpeg" name="image">
                                      <small class="text-danger">taille d'image recommandée 200px
                                        x 40px</small>

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
                          <div class="modal fade" id="confirmationModal<?= $article->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Supprimer <?= htmlspecialchars($article->getTitre()) ?>
                                  </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Etes-vous sur de vouloir supprimer?

                                </div>
                                <div class="modal-footer">
                                  <form action="/article/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $article->getId() ?>">
                                    <input name="cle" type="hidden" value="<?= cleCryptee($article->getId()) ?>" />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <button class="btn btn-danger" type="submit" name="submit">Oui</button>
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