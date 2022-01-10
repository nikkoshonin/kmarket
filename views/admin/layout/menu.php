<div class="hright">
    <div class="dropdown">
        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
    </div>
</div>
</div>
</div>
<div id="left-sidebar" class="sidebar">
    <h5 class="brand-name ">K-Market<a href="javascript:void(0) " class="menu_option float-right "><i class="fa fa-table font-16 " data-toggle="tooltip " data-placement="left " title="Grid & List Toggle "></i></a></h5>
    <nav id="left-sidebar-nav " class="sidebar-nav ">
        <ul class="metismenu ">
            <li class="g_heading "></li>
            <li><a href="/article"><i class="fa fa-amazon"></i><span>Produit</span></a></li>
            <li><a href="/categorie"><i class="fa fa-cubes"></i><span>Catégorie</span></a></li>
            <?php if ($_SESSION['role'] == cleCryptee(2)) { ?>
                <li><a href="/utilisateur"><i class="fa fa-user-circle-o "></i><span>Utilisateur</span></a>
                <?php } ?>

                </li>
                <li><a href="/main/logout"><i class="fa fa-sign-out"></i><span>Déconnexion</span></a></li>

                </li>
        </ul>
    </nav>
</div>