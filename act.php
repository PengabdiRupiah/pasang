<?php
    session_start();
    require 'dbcon.php';

    $nama = isset($_POST['nama']) ? $_POST['nama'] : "";
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
    $daya = isset($_POST['daya']) ? $_POST['daya'] : "";
    $notelp = isset($_POST['no_telp']) ? $_POST['no_telp'] : "";

    $queryCheck = "SELECT * FROM tb_1 WHERE nama = '$nama' AND alamat = '$alamat'";
    $resultCheck = mysqli_query($conn, $queryCheck);
    
    if (mysqli_num_rows($resultCheck) > 0) {
        $_SESSION['message'] = "Data sudah ada";
        header("Location: survey.php");
        exit(0);
    } else {
        $queryInsert = "INSERT INTO tb_1 (nama, alamat, daya, no_telp) VALUES ('$nama', '$alamat', '$daya', '$notelp')";
    
        if (mysqli_query($conn, $queryInsert)) {
            $_SESSION['message'] = "success";
            header("Location: survey.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Can Not Created";
            header("Location: survey.php");
            exit(0);
        }
    }
    

?>