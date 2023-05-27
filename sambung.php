<?php
    require 'dbcon.php';

    $query = "SELECT * FROM tb_4";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Data TB_4</title>
</head>
<body>
    <div class="container">
        <h1>Data TB_4</h1>
        <div class="wrp">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya</th>
                        <th>No. Telp</th>
                        <th>File</th>
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
