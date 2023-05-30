<?php
session_start();
require 'dbcon.php';

$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$daya_awal = isset($_POST['daya']) ? $_POST['daya'] : "";
$daya_baru = isset($_POST['daya_baru']) ? $_POST['daya_baru'] : "";
$no_telp = isset($_POST['no_telp']) ? $_POST['no_telp'] : "";

$queryCheck = "SELECT * FROM regist WHERE nama = '$nama' AND alamat = '$alamat'";
$resultCheck = mysqli_query($conn, $queryCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    $_SESSION['message'] = "Data sudah ada";
    header("Location: regist.php");
    exit(0);
} else {
    $queryInsert = "INSERT INTO regist (nama, alamat, daya, daya_baru, no_telp) VALUES ('$nama', '$alamat', '$daya_awal', '$daya_baru', '$no_telp')";

    if (mysqli_query($conn, $queryInsert)) {
        $_SESSION['message'] = "success";
        header("Location: regist.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Can Not Created";
        header("Location: regist.php");
        exit(0);
    }
}
?>
