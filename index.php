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
        *, html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
        img {
            width: 30%;
            height: 30%;
        }
        .logo {
            display: flex;
            justify-content: center;
            padding-bottom: 30px;
            padding-top: 30px;
        }
    </style>
</head>

<body>
    <div class="exit-button">
        <a href="menu.html" class="btn btn-secondary">Exit</a>
    </div>
    <div class="sidebar">
        <div class="logo">
            <img src="logopln.png" alt="">
        </div>
        <a href="#">
            <div class="menu-item">Dashboard</div>
        </a>
        <a href="regis.php" onclick="loadContent('regis.php')">
            <div class="menu-item">Daftar</div>
        </a>
        <a href="survey.php" onclick="loadContent('survey.php')">
            <div class="menu-item">Survei</div>
        </a>
        <a href="pendaftaran.php" onclick="loadContent('pendaftaran.php')">
            <div class="menu-item">Daftar PLN Mobile</div>
        </a>
        <a href="aktivasi.php" onclick="loadContent('aktivasi.php')">
            <div class="menu-item">Aktivasi Meter</div>
        </a>
        <a href="sambung.php" onclick="loadContent('sambung.php')">
            <div class="menu-item">Penyambungan Meter</div>
        </a>
    </div>
    <div class="content" id="content">
        <div class="container">
            <h1>Pasang Baru</h1>

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
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
