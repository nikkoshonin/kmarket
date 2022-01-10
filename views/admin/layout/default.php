<?php
    /*Just for your server-side code*/
    header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/index.html  07 Jan 2020 03:37:47 GMT -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="icon" href="../admin/images/favicon.ico" type="image/x-icon" />

  <title>:: K-Market. :: Project Dashboard</title>

  <!-- Bootstrap Core and vandor -->
  <link rel="stylesheet" href="../admin/plugins/bootstrap/css/bootstrap.css" />

  <!-- Plugins css -->
  <!-- Core css -->
  <link rel="stylesheet" href="../admin/css/main.css" />
  <link rel="stylesheet" href="../admin/css/theme1.css" />
  <link rel="stylesheet" href="../admin/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../admin/plugins/dropify/css/dropify.min.css">
  <link rel="stylesheet" href="../admin/css/dataTables.bootstrap4.min.css">

  <!--- ?php include("Views/admin/share/head.php"); ?> --->

</head>

<body class="font-montserrat">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
    </div>
  </div>
  <div id="main_content">
    <div id="header_top" class="header_top">
      <div class="container">
        <div class="hleft">
          <a href="javascript:void(0)">
            <img src="../admin/images/favicon.icoo" alt="k-Market" style="max-width: 64%;" />
          </a>
          <div class="dropdown">
            <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="../admin/images/user.png" alt="" data-toggle="tooltip" data-placement="right" title="User Menu" />
            </a>
          </div>
        </div>

        <?php include("../Views/admin/layout/menu.php"); ?>

        <div class="page ">
          <div id="page_top " class="section-body top_dark ">
            <div class="container-fluid ">
              <div class="page-header ">
                <div class="left ">
                  <a href="javascript:void(0) " class="icon menu_toggle mr-3 "><i class="fa fa-align-left "></i></a>
                  <h1 class="page-title ">Admin K-Market</h1>
                </div>
              </div>
            </div>
          </div>
          <div style="margin-top: 20px;">
            <?= $content ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- soccer/project/index.html  07 Jan 2020 03:37:47 GMT -->

</html> <?php include("../Views/admin/layout/script.php"); ?>
