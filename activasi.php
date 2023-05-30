<?php
    require 'dbcon.php';

    $query = "SELECT * FROM tb_22";
    $result = mysqli_query($conn, $query);

    if(isset($_POST['next'])){
        $id = $_POST['id'];

        // Mengambil data dari tb_3 berdasarkan id
        $select_query = "SELECT * FROM tb_22 WHERE id = '$id'";
        $select_result = mysqli_query($conn, $select_query);
        $row = mysqli_fetch_assoc($select_result);

        if ($row) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $daya = $row['daya'];
            $dayabaru = $row['daya_baru'];
            $no_telp = $row['no_telp'];

            // Memindahkan data ke tb_4
            $insert_query = "INSERT INTO tb_33 (nama, alamat, daya, daya_baru, no_telp) VALUES ('$nama', '$alamat', '$daya', '$dayabaru','$no_telp')";
            mysqli_query($conn, $insert_query);

            // Menghapus data dari tb_3 berdasarkan id
            $delete_query = "DELETE FROM tb_22 WHERE id = '$id'";
            mysqli_query($conn, $delete_query);
        }

        // Mengarahkan ke halaman selanjutnya
        header("Location: smbng.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Aktivasi</title>
</head>
<body>
    <div class="container">
        <h1>Data Aktivasi</h1>
        <div class="wrp">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya Awal</th>
                        <th>Daya Baru</th>
                        <th>Next</th>
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
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button type="submit" name="next" class="btn btn-success">Next</button>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
