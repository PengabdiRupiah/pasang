<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Form Survey</title>
</head>

<body>
    <div class="container">
        <h1>Form Survey</h1>
        <div class="wrp">
            <form id="MyForm" action="act.php" method="POST" enctype="multipart/form-data">
                <div class="sec">
                    <label for="nama">Nama:</label>
                    <div class="wp">
                        <input type="text" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="sec">
                    <label for="alamat">Alamat:</label>
                    <div class="wp">
                        <textarea id="alamat" name="alamat" required></textarea>
                    </div>
                </div>
                <div class="sec">
                    <label for="daya">Daya:</label>
                    <div class="wp">
                        <input id="daya" name="daya" required></input>
                    </div>
                </div>
                <div class="sec">
                    <label for="no_telp">No.Telp:</label>
                    <div class="wp">
                        <input id="no_telp" name="no_telp" required></input>
                    </div>
                </div>
                </div>
                <div class="sec">
                    <input type="submit" id="submitBtn" value="Submit">
                </div>
                <div class="show">
                    <button onclick="location.href='index.html'">BACK</button>
                </div>
            </form>
        </div>
    </div>
    <script src="notif.js"></script>
</body>

</html>