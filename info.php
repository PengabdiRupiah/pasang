<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .card {
            background-color: #f8f9fa;
            border: none;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dashboard</h1>

        <div class="row">
            <?php
require 'dbcon.php';

            // Daftar tabel yang ingin ditampilkan
            $tables = array("tb_1" => "Survey", "tb_2" => "PLN Mobile", "tb_3" => "Aktivasi", "tb_4" => "Pemasangan");

            foreach ($tables as $table => $label) {
                $countSql = "SELECT COUNT(*) FROM $table";
                $countResult = $conn->query($countSql);
                $count = $countResult->fetch_row()[0];

                echo "<div class='col-sm-6 col-md-4 col-lg-3 mb-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body text-center'>";
                echo "<h5 class='card-title'>$label</h5>";
                echo "<p class='card-text'>Jumlah data: $count</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            // Menutup koneksi
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
