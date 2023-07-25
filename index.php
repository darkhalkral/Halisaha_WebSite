<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    header("Location: home.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Amogus Halısaha Sitesi">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Amogus Halısaha</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Amogus Halısaha</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block"><img alt="amogus" style="width: 70%;" src="data:image/png;base64,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" /></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Hoşgelmişen!</h1>
                                        </div>
                                        <form class="user" action="login.php" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="kadi" name="kadi" placeholder="Kullanıcı Adı Giriniz">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="sifre" name="sifre" placeholder="Şifre">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>

                                            <?php if (isset($_GET['error'])) { ?>
                                                <p class="error-invalid-feedback" style="color:red;"><?php echo $_GET['error']; ?></p>
                                            <?php } ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="container">
            <p>© 2023-2024 Darkhalkral, halidkrgz.</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

</html>