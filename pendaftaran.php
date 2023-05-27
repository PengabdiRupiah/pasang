<?php
    require 'dbcon.php';

    // Fungsi untuk mendapatkan nama file dari URL
    function getFileNameFromUrl($url) {
        $path = parse_url($url, PHP_URL_PATH);
        $file = basename($path);
        return $file;
    }

    // Fungsi untuk mendownload file
    function downloadFile($fileUrl) {
        $fileName = getFileNameFromUrl($fileUrl);
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        readfile($fileUrl);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? $_POST['id'] : "";

        // Mendapatkan data dari tabel tb_2 berdasarkan id
        $selectQuery = "SELECT * FROM tb_2 WHERE id='$id'";
        $result = mysqli_query($conn, $selectQuery);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Memasukkan data ke tabel tb_3
            $insertQuery = "INSERT INTO tb_3 (nama, alamat, daya, no_telp, teknis, p2tl, tunggakan, file_path) VALUES ('{$row['nama']}', '{$row['alamat']}', '{$row['daya']}', '{$row['no_telp']}', '{$row['teknis']}', '{$row['p2tl']}', '{$row['tunggakan']}', '{$row['file_path']}')";
            mysqli_query($conn, $insertQuery);

            // Menghapus data dari tabel tb_2
            $deleteQuery = "DELETE FROM tb_2 WHERE id='$id'";
            mysqli_query($conn, $deleteQuery);

            // Mengarahkan ke halaman aktivasi.php
            header('Location: aktivasi.php');
            exit;
        }
    }

    $query = "SELECT * FROM tb_2";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Data Survey</title>
</head>

<body>
    <div class="container">
        <h1>Data Survey</h1>
        <div class="wrp">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya</th>
                        <th>No. Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['daya']; ?></td>
                                    <td><?= $row['no_telp']; ?></td>
                                    <td>
                                        <?php if (!empty($row['file_path'])) { ?>
                                            <a href="<?= $row['file_path']; ?>" download>Download</a>
                                        <?php } ?>
                                        <form method="POST" action="pendaftaran.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button type="submit">Next</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">Data tidak tersedia.</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="show">
            <button onclick="location.href='index.html'">BACK</button>
        </div>
    </div>
</body>

</html>
