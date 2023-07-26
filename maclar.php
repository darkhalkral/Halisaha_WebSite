<?php
session_start();
include "conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $sql0 = "SELECT * FROM oyuncu WHERE Isim='" . $_SESSION['name'] . "'";
    $result0 = mysqli_query($conn, $sql0);
    $row0 = mysqli_fetch_assoc($result0);
    $oyuncuid = $row0['OyuncuId'];
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="Amogus Halısaha Sitesi">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="stylee.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <title>Amogus Halısaha</title>
    </head>

    <body>
        <style>

        </style>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Amogus Halısaha</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Anasayfa <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="">Maçlar<span class="sr-only">(current)</span></a>
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
                <div class="col-xl-12 col-lg-12 col-md-9 col-xs-5">
                    <div class="card o-hidden border-0 shadow-lg my-5 deneme">
                        <div class="card-header">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['name']; ?> için Maç Verileri
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="card" style="max-width:600px;">
                                <div class="card-header">
                                    <h3 class="h3 mb-0 text-gray-800">Winstreak</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <table class="table table-bordered table-responsive tablewidthden" style="border-color: black;">
                                            <thead>
                                                <tr>
                                                    <th>İsim</th>
                                                    <?php
                                                    $sql = "SELECT * FROM oyuncu Where WinStreak>0 ORDER BY WinStreak DESC";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['OyuncuId'] == $oyuncuid)
                                                            echo "<th bgcolor=#bee5eb>" . $row['Isim'] . "</th>";
                                                        else
                                                            echo "<td>" . $row['Isim'] . "</td>";
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>WinStreak</strong></td>
                                                    <?php
                                                    $sql = "SELECT * FROM oyuncu Where WinStreak>0 ORDER BY WinStreak DESC";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['WinStreak'] >= 3)
                                                            $renk2 = "danger";
                                                        else if ($row['WinStreak'] > 1)
                                                            $renk2 = "warning";
                                                        else
                                                            $renk2 = "success";
                                                        if ($row['OyuncuId'] == $oyuncuid)
                                                            echo "<td bgcolor=#bee5eb>" . $row['WinStreak'] . "</td>";
                                                        else
                                                            echo "<td style='font-size:130%; text-align:center;'><span class='badge bg-" . $renk2 . "'>" . $row['WinStreak'] . "</span></td>";
                                                    }
                                                    ?>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div style="float:left;" class="card denememargin">
                                <div class="card-header">
                                    <h3 class="h3 mb-0 text-gray-800">Win-Lose Tablo</h3>
                                </div>
                                <div class="card-body">
                                    <table style="border-color: black;max-height:600px;padding:20px;" class="table  table-responsive" id="dataTable" >
                                        <thead>
                                            <tr>
                                                <th>Oyuncu</th>
                                                <th>Win</th>
                                                <th>Lose</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM oyuncu ORDER BY Win DESC";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                if ($row['OyuncuId'] == $oyuncuid)
                                                    echo "<tr bgcolor=#bee5eb>";
                                                else
                                                    echo "<tr>";
                                                echo "<td>" . $row['Isim'] . "</td>";
                                                echo "<td>" . $row['Win'] . "</td>";
                                                echo "<td>" . $row['Lose'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="float:left;" class="card denememargin">
                                <div class="card-header">
                                    <h3 class="h3 mb-0 text-gray-800">Maçlar</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <table class="table table-bordered table-responsive" style="max-height:600px;padding:20px;" id="dataTable" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Tarih</th>
                                                    <th>Takım1</th>
                                                    <th>Skor</th>
                                                    <th>Takım2</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT m.Tarih as Tarih,
            t1.oyuncu1 AS Takim1Oyuncu1,
            t1.oyuncu2 AS Takim1Oyuncu2,
            t1.oyuncu3 AS Takim1Oyuncu3,
            t1.oyuncu4 AS Takim1Oyuncu4,
            t1.oyuncu5 AS Takim1Oyuncu5,
            t1.oyuncu6 AS Takim1Oyuncu6,
            t1.oyuncu7 AS Takim1Oyuncu7,
            t1.oyuncu8 AS Takim1Oyuncu8,
            m.Takim1Skor,
            m.Takim2Skor,
            t2.oyuncu1 AS Takim2Oyuncu1,
            t2.oyuncu2 AS Takim2Oyuncu2,
            t2.oyuncu3 AS Takim2Oyuncu3,
            t2.oyuncu4 AS Takim2Oyuncu4,
            t2.oyuncu5 AS Takim2Oyuncu5,
            t2.oyuncu6 AS Takim2Oyuncu6,
            t2.oyuncu7 AS Takim2Oyuncu7,
            t2.oyuncu8 AS Takim2Oyuncu8
         FROM mac m
         INNER JOIN takim t1 ON m.Takim1Id = t1.TakimId
         INNER JOIN takim t2 ON m.Takim2Id = t2.TakimId
         ORDER BY Tarih DESC";

                                                $result = mysqli_query($conn, $sql);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($row['Takim1Oyuncu1'] == $oyuncuid || $row['Takim1Oyuncu2'] == $oyuncuid || $row['Takim1Oyuncu3'] == $oyuncuid || $row['Takim1Oyuncu4'] == $oyuncuid || $row['Takim1Oyuncu5'] == $oyuncuid || $row['Takim1Oyuncu6'] == $oyuncuid || $row['Takim1Oyuncu7'] == $oyuncuid || $row['Takim1Oyuncu8'] == $oyuncuid)
                                                        $bgcolor = "#c3e6cb";
                                                    else if ($row['Takim2Oyuncu1'] == $oyuncuid || $row['Takim2Oyuncu2'] == $oyuncuid || $row['Takim2Oyuncu3'] == $oyuncuid || $row['Takim2Oyuncu4'] == $oyuncuid || $row['Takim2Oyuncu5'] == $oyuncuid || $row['Takim2Oyuncu6'] == $oyuncuid || $row['Takim2Oyuncu7'] == $oyuncuid || $row['Takim2Oyuncu8'] == $oyuncuid)
                                                        $bgcolor = "#f5c6cb";
                                                    else
                                                        $bgcolor = "#ffeeba";

                                                    for ($i = 8; $i >= 4; $i--) {
                                                        echo "<tr bgcolor=$bgcolor>";
                                                        if ($row['Takim1Oyuncu' . $i] != NULL || $row['Takim2Oyuncu' . $i] != NULL) {
                                                            echo "<td style='vertical-align:middle' rowspan='" . $i . "'>" . $row['Tarih'] . "</td>";

                                                            for ($j = 1; $j <= $i; $j++) {
                                                                if ($j != 1)
                                                                    echo "<tr bgcolor=$bgcolor>";

                                                                if ($row['Takim1Oyuncu' . $j] == NULL)
                                                                    echo "<td></td>";
                                                                else {
                                                                    $sql2 = "SELECT * FROM oyuncu WHERE OyuncuId='" . $row['Takim1Oyuncu' . $j] . "'";
                                                                    $result2 = mysqli_query($conn, $sql2);
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    echo "<td>" . $row2['Isim'] . "</td>";
                                                                }

                                                                if ($j == 1) {
                                                                    echo "<td style='vertical-align:middle' rowspan='" . $i . "'>" . $row['Takim1Skor'] . " - " . $row['Takim2Skor'] . "</td>";
                                                                }

                                                                if ($row['Takim2Oyuncu' . $j] == NULL)
                                                                    echo "<td></td>";
                                                                else {
                                                                    $sql3 = "SELECT * FROM oyuncu WHERE OyuncuId='" . $row['Takim2Oyuncu' . $j] . "'";
                                                                    $result3 = mysqli_query($conn, $sql3);
                                                                    $row3 = mysqli_fetch_assoc($result3);
                                                                    echo "<td>" . $row3['Isim'] . "</td>";
                                                                }

                                                                echo "</tr>";
                                                            }
                                                            echo "<tr><td colspan='5'><hr style='border-color: black;'></td></tr>";
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div style="float:left;" class="card denememargin">
                                <div class="card-header">
                                    <h3 class="h3 mb-0 text-gray-800">Winrate Oranı</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive" style="max-height:600px;padding:20px;" id="dataTable" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Oyuncu</th>
                                                <th>Winrate</th>
                                                <th>Oran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql4 = "SELECT OyuncuId,Isim,Round((win/(win+lose))*100) as Winrate FROM oyuncu ORDER BY Winrate DESC;";
                                            $result4 = mysqli_query($conn, $sql4);
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                if ($row4['OyuncuId'] == $oyuncuid)
                                                    echo "<tr bgcolor=#bee5eb>";
                                                else
                                                    echo "<tr>";
                                                echo "<td>" . $row4['Isim'] . "</td>";
                                                if ($row4['Winrate'] >= 60)
                                                    echo "<td><span class='badge bg-success'>" . $row4['Winrate'] . "%</span></td>";
                                                else if ($row4['Winrate'] >= 40)
                                                    echo "<td><span class='badge bg-warning'>" . $row4['Winrate'] . "%</span></td>";
                                                else
                                                    echo "<td><span class='badge bg-danger'>" . $row4['Winrate'] . "%</span></td>";
                                                echo "<td><div class='progress'>
                                                <div class='progress-bar' style='width:" . $row4['Winrate'] . "%'></div>
                                            </div></td>";
                                                echo "</tr>";
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer class="container">
            <p>© 2023-2024 Darkhalkral, halidkrgz.</p>
        </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>