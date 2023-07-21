<?php
session_start();
include "conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                    <li class="nav-item">
                        <a class="nav-link" href="maclar.php">Maçlar<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="puanlar.php">Puanlar<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item  active">
                        <a class="nav-link" href="">Puan Formu <span class="sr-only">(current)</span></a>
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
        <?php

        $sqlt = "SELECT Tarih FROM mac order by tarih desc limit 1";
        $resultt = mysqli_query($conn, $sqlt);
        $rowt = mysqli_fetch_assoc($resultt);
        $sql = "SELECT * FROM oyuncu WHERE Isim='" . $_SESSION['name'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $sql2 = "SELECT m.MacId,
        t1.oyuncu1 AS Takim1Oyuncu1,
        t1.oyuncu2 AS Takim1Oyuncu2,
        t1.oyuncu3 AS Takim1Oyuncu3,
        t1.oyuncu4 AS Takim1Oyuncu4,
        t1.oyuncu5 AS Takim1Oyuncu5,
        t1.oyuncu6 AS Takim1Oyuncu6,
        t1.oyuncu7 AS Takim1Oyuncu7,
        t1.oyuncu8 AS Takim1Oyuncu8,
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
 INNER JOIN takim t2 ON m.Takim2Id = t2.TakimId where " . $row['OyuncuId'] . " IN(
    t1.oyuncu1, t1.oyuncu2, t1.oyuncu3, t1.oyuncu4, t1.oyuncu5, t1.oyuncu6, t1.oyuncu7, t1.oyuncu8,
    t2.oyuncu1, t2.oyuncu2, t2.oyuncu3, t2.oyuncu4, t2.oyuncu5, t2.oyuncu6, t2.oyuncu7, t2.oyuncu8) and m.Tarih='" . $rowt['Tarih'] . "'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        if (mysqli_num_rows($result2) == 1) {
            $sqlvarmi = "SELECT * FROM oyuncupuan WHERE GirenOyuncuId=" . $row['OyuncuId'] . " and MacId=" . $row2['MacId'];
            $resultvarmi = mysqli_query($conn, $sqlvarmi);
            $rowvarmi = mysqli_fetch_assoc($resultvarmi);
        ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5 deneme">
                            <div class="card-header">
                                <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['name']; ?> için Maç Puanlama Formu
                                </h1>
                            </div>
                            <div class="card-body justify-content-center">
                                <?php
                                if (mysqli_num_rows($resultvarmi) > 0) {
                                    echo "Bu maç için puanlama formu doldurulmuş. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <footer class='container'>
                                <p>© 2023-2024 Darkhalkral, halidkrgz.</p>
                            </footer>
                        </body>";
                                } else {
                                ?>
                                    <form method="post" action="veriekle.php">
                                        <input name=macid type=hidden value=<?php echo $row2['MacId']; ?>>
                                        <table class="table table-responsive table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Oyuncu No</th>
                                                    <th>Oyuncu Adı</th>
                                                    <th>Maç Puanı</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                echo "<tr><td colspan=3>Takım 1 Oyuncuları</td></tr>";
                                                for ($i = 1; $i <= 8; $i++) {
                                                    if ($row2['Takim1Oyuncu' . $i] != NULL && $row2['Takim1Oyuncu' . $i] != $row['OyuncuId']) {
                                                        $sqlo = "select * from oyuncu where OyuncuId = " . $row2['Takim1Oyuncu' . $i];
                                                        $resulto = mysqli_query($conn, $sqlo);
                                                        $rowo = mysqli_fetch_assoc($resulto);
                                                        echo "<td>" . $row2['Takim1Oyuncu' . $i] . "</td><td>" . $rowo['Isim'] . "</td>
                                    <td><select class=form-control name='to" . $row2['Takim1Oyuncu' . $i] . "' style='max-width:75%;' required>
                                    <option value='' disabled selected hidden></option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option>
                                    <option value='9'>9</option>
                                    <option value='10'>10</option></select></td>
                                    </select></td>
                                    </tr>";
                                                    }
                                                }
                                                echo "<tr><td colspan=3>Takım 2 Oyuncuları</td></tr>";
                                                for ($i = 1; $i <= 8; $i++) {
                                                    if ($row2['Takim2Oyuncu' . $i] != NULL && $row2['Takim2Oyuncu' . $i] != $row['OyuncuId']) {
                                                        $sqlo = "select * from oyuncu where OyuncuId = " . $row2['Takim2Oyuncu' . $i];
                                                        $resulto = mysqli_query($conn, $sqlo);
                                                        $rowo = mysqli_fetch_assoc($resulto);
                                                        echo "<td>" . $row2['Takim2Oyuncu' . $i] . "</td><td>" . $rowo['Isim'] . "</td>
                                    <td><select class=form-control name='to" . $row2['Takim2Oyuncu' . $i] . "'style='max-width:75%;' required>
                                    <option value='' disabled selected hidden></option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option>
                                    <option value='9'>9</option>
                                    <option value='10'>10</option></select></td>
                                    </select></td>
                                    </tr>";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Onayla</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="container">
                <p>© 2023-2024 Darkhalkral, halidkrgz.</p>
            </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </html>
<?php }
                            } else {
                                echo "Maç bulunamadı";
                            }
                            echo "</body></html>";
                        } else {
                            header("Location: index.php");
                            exit();
                        }
?>