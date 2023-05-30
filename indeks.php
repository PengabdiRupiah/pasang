<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
        function loadContent(url) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("content").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
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
        
        .exit-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
    <div class="exit-button">
        <a href="menu.html" class="btn btn-secondary">Exit</a>
    </div>
    <div class="sidebar">
        <a href="#">
            <div class="menu-item">Dashboard</div>
        </a>
        <a href="regist.php" onclick="loadContent('regist.php')">
            <div class="menu-item">Daftar</div>
        </a>
        <a href="pndftrn.php" onclick="loadContent('pndftrn.php')">
            <div class="menu-item">Daftar PLN Mobile</div>
        </a>
        <a href="activasi.php" onclick="loadContent('activasi.php')">
            <div class="menu-item">Pembayaran</div>
        </a>
        <a href="smbng.php" onclick="loadContent('smbng.php')">
            <div class="menu-item">Proses Tambah Daya</div>
        </a>
    </div>
    <div class="content" id="content">
        <div class="container">
            <h1>Tambah Daya</h1>

            <div class="row">
                <?php
                require 'dbcon.php';

                // Daftar tabel yang ingin ditampilkan
                $tables = array("regist" => "PLN Mobile", "tb_22" => "Pembayaran", "tb_33" => "Proses");

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
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
