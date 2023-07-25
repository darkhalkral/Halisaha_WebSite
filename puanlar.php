<?php
session_start();
include "conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $sqlo = "SELECT * FROM oyuncu where OyuncuId = " . $_SESSION['id'];
    $resulto = mysqli_query($conn, $sqlo);
    $rowo = mysqli_fetch_assoc($resulto);
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
        <script src="dist\js\adminlte.min.js"></script>
        <script src="plugins\chart.js/Chart.min.js"></script>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="">Puanlar<span class="sr-only">(current)</span></a>
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
                <div class="col-xl-12 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5 deneme">
                        <div class="card-header">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['name']; ?> için Puanlar
                            </h1>
                        </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT MacId,GirilenOyuncuId,Round(AVG(Puan)) as Puan FROM oyuncupuan where GirilenOyuncuId=" . $rowo["OyuncuId"] . " GROUP BY GirilenOyuncuId, MacId ORDER BY MacId ASC";
                            $result = mysqli_query($conn, $sql);
                            $data = array();
                            $data2 = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sql2 = "SELECT * FROM mac WHERE MacId = " . $row['MacId'];
                                $result2 = mysqli_query($conn, $sql2);
                                $row2 = mysqli_fetch_assoc($result2);
                                $data1[] = $row['Puan'];
                                $data2[] = $row2['Tarih'];
                            }
                            ?>
                            <div style="float:left;" class="card">
                                <div class="card-header">
                                    <h1 class="h3 mb-0 text-gray-800"><?php echo $rowo["Isim"] ?> İçin Haftalık Puan Grafiği</h1>
                                </div>
                                <div class="card-body">
                                    <div id="chartContainer">
                                        <canvas id="myChart" width="400" height="400" class=""></canvas>
                                    </div>
                                </div>
                            </div>
                            <div style="float:left;" class="card denememargin2">
                                <div class="card-header">
                                    <h1 class="h3 mb-0 text-gray-800">Ortalama Puan Tablosu</h1>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">İsim</th>
                                                <th scope="col">Ortalama Puan</th>
                                                <th scope="col">Oran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT GirilenOyuncuId,Round(AVG(Puan)) as Puan FROM oyuncupuan GROUP BY GirilenOyuncuId ORDER BY Puan DESC";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $sql2 = "SELECT * FROM oyuncu WHERE OyuncuId = " . $row['GirilenOyuncuId'];
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                echo "<tr>";
                                                echo "<td>" . $row2['Isim'] . "</td>";
                                                echo "<td>" . $row['Puan'] . "</td>";
                                                echo "<td> <div class='progress'>
                                            <div class='progress-bar' style='width:" . ($row['Puan'] * 10) . "%'></div>
                                        </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="float:left;" class="card denememargin2">
                                <div class="card-header">
                                    <h1 class="h3 mb-0 text-gray-800">Oyuncuya Özel Puan Grafiği</h1>
                                </div>
                                <div class="card-body">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                        echo "<option value='' hidden>" . $rowo["Isim"] . "</option>";
                                        $sql = "SELECT * FROM oyuncupuan INNER JOIN oyuncu ON oyuncupuan.GirilenOyuncuId = oyuncu.OyuncuId GROUP BY oyuncupuan.GirilenOyuncuId";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['OyuncuId'] . "'>" . $row['Isim'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <div id="chartContainer">
                                        <canvas id="myChart2" width="400" height="400"></canvas>
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
    <script>
        const myChart = new Chart(document.getElementById("myChart"), {
            type: "line",
            data: {
                labels: <?php echo json_encode($data2); ?>,
                datasets: [{
                    label: "Puanlar",
                    data: <?php echo json_encode($data1); ?>,
                    fill: false, // To remove the area under the line
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderColor: 'rgba(220, 220, 220, 1)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 2,
                    lineTension: 0.2, // Adjust the line curve (0 to 1)
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time', // Assuming 'Tarih' field is in date format
                        time: {
                            unit: 'day', // Adjust this based on your data
                            tooltipFormat: 'YYYY-MM-DD', // Tooltip format for the x-axis labels
                            displayFormats: {
                                day: 'YYYY-MM-DD' // Display format for the x-axis labels
                            }
                        },
                    },
                    yAxes: [{
                        ticks: {
                            max: 10,
                            min: 0,
                            stepSize: 1,

                        }
                    }]
                }
            }
        });

        function updateChart(selectedOptionValue) {
            $.ajax({
                url: 'fetchDataForSelectedOption.php',
                method: 'POST',
                data: {
                    selectedOption: selectedOptionValue
                },
                dataType: 'json',
                success: function(data) {
                    mySecondChart.data.labels = data.labels;
                    mySecondChart.data.datasets[0].data = data.values;
                    mySecondChart.update();
                },
                error: function(error) {
                    console.log('Error fetching data:', error);
                }
            });
        }

        const mySecondChart = new Chart(document.getElementById("myChart2"), {
            type: "line",
            data: {
                labels: <?php echo json_encode($data2); ?>,
                datasets: [{
                    label: "Puanlar",
                    data: <?php echo json_encode($data1); ?>,
                    fill: false, // To remove the area under the line
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderColor: 'rgba(220, 220, 220, 1)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 2,
                    lineTension: 0.2, // Adjust the line curve (0 to 1)
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time', // Assuming 'Tarih' field is in date format
                        time: {
                            unit: 'day', // Adjust this based on your data
                            tooltipFormat: 'YYYY-MM-DD', // Tooltip format for the x-axis labels
                            displayFormats: {
                                day: 'YYYY-MM-DD' // Display format for the x-axis labels
                            }
                        },
                    },
                    yAxes: [{
                        ticks: {
                            max: 10,
                            min: 0,
                            stepSize: 1,

                        }
                    }]
                }
            }
        });
        $('#exampleFormControlSelect1').change(function() {
            const selectedOptionValue = $(this).val();
            updateChart(selectedOptionValue);
        });
    </script>

    </html>
<?php } else {
    header("Location: index.php");
    exit();
} ?>