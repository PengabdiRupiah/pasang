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
        $selectQuery = "SELECT * FROM regist WHERE id='$id'";
        $result = mysqli_query($conn, $selectQuery);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Memasukkan data ke tabel tb_3
            $insertQuery = "INSERT INTO tb_22 (nama, alamat, daya, daya_baru, no_telp) VALUES ('{$row['nama']}', '{$row['alamat']}', '{$row['daya']}', '{$row['daya_baru']}', '{$row['no_telp']}')";
            mysqli_query($conn, $insertQuery);

            // Menghapus data dari tabel tb_2
            $deleteQuery = "DELETE FROM regist WHERE id='$id'";
            mysqli_query($conn, $deleteQuery);

            // Mengarahkan ke halaman aktivasi.php
            header('Location: pndftrn.php');
            exit;
        }
    }

    $query = "SELECT * FROM regist";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Pasang Baru</title>
</head>

<body>
    <div class="container">
        <h1>Data Survei</h1>
        <div class="wrp">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya Awal</th>
                        <th>Daya Baru</th>
                        <th>NO.Telp</th>
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
                                    <td><?= $row['daya_baru']; ?></td>
                                    <td><?= $row['no_telp']; ?></td>
                                    <td>
                                        <form method="POST" action="pndftrn.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">Next</button>
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
            <button onclick="location.href='indeks.php'" class="btn btn-secondary">BACK</button>
        </div>
    </div>
</body>

</html>
