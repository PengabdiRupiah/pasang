<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Form Survey</title>
</head>

<body>
    <div class="container">
        <h1>Daftar Pasang Baru</h1>
        <div class="wrp">
            <form id="MyForm" action="act.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                      <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <div class="form-group">
                    <label for="daya">Daya:</label>
                    <input class="form-control" id="daya" name="daya" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No.Telp:</label>
                    <input class="form-control" id="no_telp" name="no_telp" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="submitBtn" value="Submit">
                </div>
                <div class="show">
                    <button class="btn btn-secondary" onclick="location.href='regis.php'">BACK</button>
                </div>
            </form>
        </div>
    </div>
    <script src="notif.js"></script>
</body>

</html>
