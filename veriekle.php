<?php
session_start();
include "conn.php";
$sql = "SELECT * FROM oyuncu";
$result = mysqli_query($conn, $sql);
$macid = $_POST['macid'];
$deger = false;
for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
    if (isset($_POST['to' . $i])) {
        $sql2="Insert into oyuncupuan (MacId, GirenOyuncuId,GirilenOyuncuId,Puan) values (".$macid.",".$_SESSION["id"].",".$i.",".$_POST['to'.$i].")";
        if ($conn->query($sql2) === TRUE) {
            $deger=true;
          } else {
            $deger=false;
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }
}
if($deger){
    header("Location: puanlar.php");
}
else{
    echo "Bir hata oluştu.";
}

?>