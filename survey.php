<?php
    require 'dbcon.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? $_POST['id'] : "";

        // Mendapatkan data dari tabel tb_1 berdasarkan id
        $selectQuery = "SELECT * FROM tb_1 WHERE id='$id'";
        $result = mysqli_query($conn, $selectQuery);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Memasukkan data ke tabel tb_terhapus
            $insertQuery = "INSERT INTO tb_2 (nama, alamat, daya, no_telp, teknis, p2tl, tunggakan, file_path) VALUES ('{$row['nama']}', '{$row['alamat']}', '{$row['daya']}', '{$row['no_telp']}', '{$row['teknis']}', '{$row['p2tl']}', '{$row['tunggakan']}', '{$row['file_path']}')";
            mysqli_query($conn, $insertQuery);

            // Menghapus data dari tabel tb_1
            $deleteQuery = "DELETE FROM tb_1 WHERE id='$id'";
            mysqli_query($conn, $deleteQuery);

            // Mengarahkan ke halaman pendaftaran.php
            header('Location: survey.php');
            exit;
        }
    }

    $query = "SELECT * FROM tb_1";
    $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Survei</title>
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
                        <th>Daya</th>
                        <th>No. Telp</th>
                        <th>Survei</th>
                        <th>Status</th>
                        <th>Upload SLO</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $isSurveyed = $row['teknis'] && $row['p2tl'] && $row['tunggakan'];
                                $status = $isSurveyed ? 'Aman' : 'Belum aman';
                                $fileUploaded = !empty($row['file_path']);
                    ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['daya']; ?></td>
                                    <td><?= $row['no_telp']; ?></td>
                                    <td>
                                        <?php if ($isSurveyed) { ?>
                                            <button class="btn btn-primary" onclick="location.href='survei.php?id=<?= $row['id']; ?>'">Edit Survei</button>
                                        <?php } else { ?>
                                            <button class="btn btn-primary" onclick="location.href='survei.php?id=<?= $row['id']; ?>'">Survei</button>
                                        <?php } ?>
                                    </td>
                                    <td><?= $status; ?></td>
                                    <td>
                                        <?php if ($isSurveyed && $status === 'Aman') { ?>
                                            <?php if ($fileUploaded) { ?>
                                                File Uploaded
                                            <?php } else { ?>
                                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf">
                                                    <input type="submit" class="btn btn-secondary" value="Upload">
                                                </form>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($status === 'Aman' && $fileUploaded) { ?>
                                            <form action="survey.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                <input type="submit" class="btn btn-primary" value="Next">
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                    ?>
                            <tr>
                                <td colspan="9">Data tidak tersedia.</td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="show">
            <button class="btn btn-secondary" onclick="location.href='index.php'">BACK</button>
        </div>
    </div>
</body>

</html>
