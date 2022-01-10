<!DOCTYPE html>
<html lang="zxx">


<head>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">

    <!-- Title -->
    <title>..:: K-MARKET ::..</title>

    <!-- Favicon -->
    <link href="../admin/images/favicon.icoo" rel="icon" type="image/x-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="../customer/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Mobile Menu -->
    <link href="../customer/css/mmenu.css" rel="stylesheet" type="text/css" />
    <link href="../customer/css/mmenu.positioning.css" rel="stylesheet" type="text/css" />

    <!-- Stylesheet -->
    <link href="../customer/style.css" rel="stylesheet" type="text/css" />


</head>

<body>

    <!-- Start: Header Section -->
    <?php include("../views/customer/layouts/header.php"); ?>
    <!-- End: Header Section -->

    <!-- Start: Page Banner -->
    <section class="page-banner services-banner">
        <div class="container">
            <div class="banner-header">
                <h2>Une sélection d'articles adaptés pour vous</h2><br>
                <h2 style="color:darkgoldenrod"><span class="animate"></span></h2><br>

                <span class="underline center"></span>
                <p class="lead" style="padding-top: 4%;">N'attendez plus...</p>
            </div>
        </div>
    </section>
    <!-- End: Page Banner -->

    <!-- Start: Products Section -->
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="books-full-width">
                    <div class="container">
                        <!-- Start: Search Section -->
                        <section class="search-filters">
                            <div class="filter-box">
                                <h3>Que recherchez vous? <br> <small>Renseigner les informations et cliquez sur le bouton</small></h3>
                                <form action="/" method="POST">
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="categorie">
                                            <option value="0">Toutes les catégories</option>
                                            <?php foreach ($categories as $categorie) : ?>
                                                <option value="<?= $categorie->getId() ?>" <?= $categorie->getId() == $selectedCategorie ?  'selected = "selected"' : "" ?>><?= strip_tags($categorie->getNom()) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Saisissez le nom du produit" id="keywords" name="search" value="<?= strip_tags($search) ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" type="submit" value="Recherche">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clear"></div>
                        </section>
                        <!-- End: Search Section -->
                        <div class="booksmedia-fullwidth">
                            <ul>
                                <?php foreach ($articles as $article) : ?>
                                    <li>
                                        <figure>
                                            <a href="<?= $article->getLienAfiliation()?>"><img style="height: 500px; width: 360px;" src="<?= $article->getImage() != ""? $article->getImage() : "../customer/images/icon.png"  ?>" alt="produit"></a>
                                            <figcaption>
                                                <header>
                                                    <h4>
                                                        <?= strip_tags($article->getTitre()) ?>
                                                    </h4>
                                                    <p><strong>Publié le:</strong> <?= $article->getDatePublication()->format('d/m/y') ?></p>
                                                    <p><strong>Catégorie :</strong> <?= strip_tags($article->getCategorieNom()) ?></p>
                                                </header>
                                                <p><?= strip_tags($article->getContenu()) ?></p>
                                                <div class="actions">
                                                    <ul>
                                                        <li>
                                                            <a href="<?= $article->getLienAfiliation()?>" target="_blank" data-toggle="blog-tags" data-placement="top" title="Sauvegarder">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-toggle="blog-tags" data-placement="top" title="Like">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F" class="fb-xfbml-parse-ignore" target="_blank" data-toggle="blog-tags" data-placement="top" title="Partager">
                                                                <i class="fa fa-share-alt"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                            <?php if (count($articles) == 0) { ?>
                                <div style="text-align: center;">
                                    <img src="../customer/images/no-product-found.png" style="height: 360px; width: 500px;" alt="No Product Found">
                                </div>
                            <?php }?>
                        </div>
                        <?php /*<nav class="navigation pagination text-center">
                            <h2 class="screen-reader-text">Posts navigation</h2>
                            <div class="nav-links">
                                <a class="prev page-numbers" href="#."><i class="fa fa-long-arrow-left"></i>
                                    Previous</a>
                                <a class="page-numbers" href="#.">1</a>
                                <span class="page-numbers current">2</span>
                                <a class="page-numbers" href="#.">3</a>
                                <a class="page-numbers" href="#.">4</a>
                                <a class="next page-numbers" href="#.">Next <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </nav>*/ ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- End: Products Section -->

    <!-- Start: Social Network -->
    <section class="social-network section-padding">

    </section>
    <!-- End: Social Network -->

    <!-- Start: Footer -->
    <?php include("../Views/customer/layouts/footer.php"); ?>
    <?php include("../Views/customer/layouts/script.php"); ?>

    <!-- End: Footer -->


</body>


</html>