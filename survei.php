<?php
    require 'dbcon.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Memperoleh data dari form
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $teknis = isset($_POST['teknis']) ? $_POST['teknis'] : 0;
        $p2tl = isset($_POST['p2tl']) ? $_POST['p2tl'] : 0;
        $tunggakan = isset($_POST['tunggakan']) ? $_POST['tunggakan'] : 0;

        // Memperbarui data pada tabel
        $query = "UPDATE tb_1 SET teknis='$teknis', p2tl='$p2tl', tunggakan='$tunggakan' WHERE id='$id'";
        mysqli_query($conn, $query);

        // Mengarahkan kembali ke halaman survey.php
        header('Location: survey.php');
        exit;
    }

    // Mendapatkan id dari parameter URL
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    // Mendapatkan data survei berdasarkan id
    if (!empty($id)) {
        $query = "SELECT * FROM tb_1 WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Survei</title>
</head>

<body>
    <div class="container">
        <h1>Survei</h1>
        <div class="wrp">
            <form id="surveyForm" action="survei.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <div class="form-group">
                    <label for="teknis">Kondisi Teknis:</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="teknis" name="teknis" value="1" <?= $row['teknis'] ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="teknis"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2tl">P2TL:</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="p2tl" name="p2tl" value="1" <?= $row['p2tl'] ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="p2tl"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tunggakan">Tunggakan:</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="tunggakan" name="tunggakan" value="1" <?= $row['tunggakan'] ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="tunggakan"></label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="submitBtn" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
        <div class="show">
            <button class="btn btn-secondary" onclick="location.href='survey.php'">Back to Survey</button>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
