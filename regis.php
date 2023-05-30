<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Form Survey</title>
</head>

<body>
    <div class="container">
        <h1>Data Pasang Baru</h1>
        <div class="mb-3">
            <a href="daftar.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya</th>
                        <th>No. Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'dbcon.php';
                    
                    // Mendapatkan data dari tabel tb_1
                    $sql = "SELECT * FROM tb_1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>" . $row['daya'] . "</td>";
                            echo "<td>" . $row['no_telp'] . "</td>";
                            echo "<td>";
                            echo "<form method='POST' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='delete' class='btn btn-danger'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }

                    // Proses operasi delete
                    if (isset($_POST['delete'])) {
                        $id = $_POST['id'];
                        $deleteSql = "DELETE FROM tb_1 WHERE id = '$id'";
                        if ($conn->query($deleteSql) === TRUE) {
                            echo "<script>alert('Data berhasil dihapus');window.location.href='regis.php';</script>";
                        } else {
                            echo "Error: " . $deleteSql . "<br>" . $conn->error;
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="show">
            <button class="btn btn-secondary" onclick="location.href='index.php'">BACK</button>
        </div>
    </div>
    <script src="notif.js"></script>
</body>

</html>
