<?php
session_start();
include 'conn.php';
$selectedOption = $_POST['selectedOption'];
$sql = "SELECT MacId, GirilenOyuncuId, Round(AVG(Puan)) as Puan FROM oyuncupuan WHERE GirilenOyuncuId = " . $selectedOption . " GROUP BY MacId ORDER BY MacId ASC";
$result = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $sql2 = "SELECT * FROM mac WHERE MacId = " . $row['MacId'];
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $data['labels'][] = $row2['Tarih'];
    $data['values'][] = $row['Puan'];
}
echo json_encode($data);
