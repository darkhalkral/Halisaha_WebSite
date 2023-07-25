<?php
session_start();
include "conn.php";
if (isset($_POST['kadi']) && isset($_POST['sifre'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['kadi']);
    $pass = validate($_POST['sifre']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM kullanici WHERE KullaniciAdi='$uname' AND KullaniciSifre='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['KullaniciAdi'] === $uname && $row['KullaniciSifre'] === $pass) {
                echo "Logged in!";
                $_SESSION['user_name'] = $row['KullaniciAdi'];
                $_SESSION['name'] = $row['Isim'];
                $_SESSION['id'] = $row['KullaniciId'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorect User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
