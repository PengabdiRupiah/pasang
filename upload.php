<?php
    require 'dbcon.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Memperoleh data dari form
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $file = $_FILES['file'];

        // Mendapatkan informasi file
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Mendapatkan ekstensi file
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Mengizinkan tipe file yang diunggah (misalnya hanya PDF atau gambar)
        $allowedExtensions = array('pdf', 'png', 'jpg', 'jpeg');

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Batasan ukuran file (dalam byte)
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = 'uploads/' . $newFileName;

                    // Memindahkan file yang diunggah ke direktori tujuan
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // Memperbarui data pada tabel dengan file_path
                    $query = "UPDATE tb_1 SET file_path='$fileDestination' WHERE id='$id'";
                    mysqli_query($conn, $query);

                    // Redirect ke halaman survey.php
                    header('Location: survey.php?id=' . $id);
                    exit();
                } else {
                    echo "Ukuran file terlalu besar. Mohon unggah file dengan ukuran maksimal 5MB.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
            }
        } else {
            echo "Tipe file tidak valid. Hanya file PDF, PNG, JPG, dan JPEG yang diizinkan.";
        }
    }
?>
