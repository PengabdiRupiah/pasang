<?php
    require 'dbcon.php';

    $query = "SELECT * FROM tb_3";
    $result = mysqli_query($conn, $query);

    if(isset($_POST['next'])){
        $id = $_POST['id'];

        // Mengambil data dari tb_3 berdasarkan id
        $select_query = "SELECT * FROM tb_3 WHERE id = '$id'";
        $select_result = mysqli_query($conn, $select_query);
        $row = mysqli_fetch_assoc($select_result);

        if ($row) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $daya = $row['daya'];
            $no_telp = $row['no_telp'];
            $file_path = $row['file_path'];

            // Memindahkan data ke tb_4
            $insert_query = "INSERT INTO tb_4 (nama, alamat, daya, no_telp, file_path) VALUES ('$nama', '$alamat', '$daya', '$no_telp', '$file_path')";
            mysqli_query($conn, $insert_query);

            // Menghapus data dari tb_3 berdasarkan id
            $delete_query = "DELETE FROM tb_3 WHERE id = '$id'";
            mysqli_query($conn, $delete_query);
        }

        // Mengarahkan ke halaman selanjutnya
        header("Location: sambung.php");
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
                        <th>Daya</th>
                        <th>No. Telp</th>
                        <th>Download SLO</th>
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
                                    <td><?= $row['no_telp']; ?></td>
                                    <td>
                                        <?php if (!empty($row['file_path'])) { ?>
                                            <a href="<?= $row['file_path']; ?>" class="btn btn-primary" download>Download</a>
                                        <?php } ?>
                                    </td>
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
                                <td colspan="7">Data tidak tersedia.</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="show">
            <button onclick="location.href='index.php'" class="btn btn-secondary">BACK</button>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
