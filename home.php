<?php
session_start();
include "conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $sql = "SELECT * FROM oyuncu WHERE Isim='" . $_SESSION['name'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $win = $row['Win'];
    $lose = $row['Lose'];
    $winrate = $win / ($win + $lose);

    if ($winrate >= 0.5) {
        $raterenk = "success";
        $ratethumbs = "up";
    } else {
        $raterenk = "danger";
        $ratethumbs = "down";
    }
    $sqlp="SELECT Round(AVG(Puan)) as Puan FROM oyuncupuan WHERE GirilenOyuncuId=".$row['OyuncuId']." GROUP BY MacId order by MacId desc LIMIT 1";
    $resultp = mysqli_query($conn, $sqlp);
    $rowp = mysqli_fetch_assoc($resultp);
    $sonpuan = $rowp['Puan'];
    $sqlap="SELECT Round(AVG(Puan)) as Puan FROM oyuncupuan WHERE GirilenOyuncuId=".$row['OyuncuId']." GROUP BY GirilenOyuncuId";
    $resultap = mysqli_query($conn, $sqlap);
    $rowap = mysqli_fetch_assoc($resultap);
    $allpuan = $rowap['Puan'];
    $winrate = round($winrate * 100) . '%';
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Amogus Halısaha Sitesi">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/6649d1fe76.js"></script>
        <script src="https://kit.fontawesome.com/8d952dabb3.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <title>Amogus Halısaha</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Amogus Halısaha</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="">Anasayfa <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maclar.php">Maçlar<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="puanlar.php">Puanlar<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms.php">Puan Formu <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://photos.app.goo.gl/iy5cSa97VRGrmNMG6">Kayıtlar <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item float-right">
                        <a class="nav-link" style="color:red;" href="logout.php">Çıkış Yap <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-header">
                            <h1 class="h3 mb-0 text-gray-800">Hoşgelmişen, <?php echo $_SESSION['name']; ?></h1>
                        </div>
                        <div class="card-body j">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box bg-<?php echo $raterenk; ?>">
                                    <span class="info-box-icon"><i class="far fa-thumbs-<?php echo $ratethumbs; ?>"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Winrate</span>
                                        <span class="info-box-number"><?php echo $row['Win']; ?> Win - <?php echo $row['Lose']; ?> Lose</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width:<?php echo $winrate; ?>"></div>
                                        </div>
                                        <span class="progress-description">
                                            <?php echo $winrate; ?> Winrate Oranı
                                        </span>
                                    </div>
                                </div>
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-fire" style="color:red";></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">WinStreak</span>
                                        <span class="info-box-number"><?php echo $row['WinStreak']; ?></span>
                                    </div>
                                </div>
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="fas fa-trophy"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Puan Durumum</span>
                                        <span class="info-box-number">Son Maç Ort = <?php echo $sonpuan; ?><br>
                                            Ortalama Puan = <?php echo $allpuan; ?></span>
                                    </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer class="container">
        <p>© 2023-2024 Darkhalkral, halidkrgz.</p>
    </footer>
    <script src="https://code.query.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
