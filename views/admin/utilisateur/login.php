<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/login.html  07 Jan 2020 03:42:43 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="../admin/images/favicon.icoo" type="image/x-icon" />


    <title>:: K-Market :: Connexion</title>
    <link rel="stylesheet" href="../admin/plugins/bootstrap/css/bootstrap.min.css" />

    <!-- Core css -->
    <link rel="stylesheet" href="../admin/css/main.css" />
    <link rel="stylesheet" href="../admin/css/theme1.css" />

    <style>
        .btn-valider {
            background-color: #ff7236;
        }
    </style>

</head>

<body class="font-montserrat">

    <div class="auth">
        <div class="auth_left">
            <div class="card">
                <div class="text-center mb-2">
                    <a href="javascript:void(0)">
                        <img src="../../admin/images/favicon.icoo" alt="k-Market" style="max-width: 64%;" />
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-title">Saisissez vos identifiants...</div>
                    <div class="form-group">
                        <label class="form-label">Nom d'utilisateur *</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mot de passe *</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div class="form-group">
                        <small id="message" class="text-danger"></small>
                    </div>
                    <div class="form-footer">
                        <a href="#" id="submitButton" class="btn disabled text-white text-bold btn-valider btn-block">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth_right full_img"></div>
    </div>

    <script src="../../admin/bundles/lib.vendor.bundle.js"></script>
    <script src="../../admin/js/core.js"></script>

    <script>
        function val() {
            if ($('#username').val() != "" && $('#password').val() != "") {
                $('#submitButton').removeClass('disabled');
            } else {
                $('#submitButton').addClass('disabled');
            }
        }

        $('#username').on('input', function(e) {
            val();
        });
        $('#password').on('input', function(e) {
            val();
        });
        $('#submitButton').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/main/login',
                data: {
                    'username': $('#username').val(),
                    'password': $('#password').val(),
                    'submit': 'submit'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.replace('/article');
                    } else {
                        document.getElementById('message').innerText = response.message;

                    }
                }
            });
        });
    </script>
</body>

<!-- soccer/project/login.html  07 Jan 2020 03:42:43 GMT -->

</html>