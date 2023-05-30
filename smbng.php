<?php
require 'dbcon.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportToExcel($data)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Alamat');
    $sheet->setCellValue('D1', 'Daya Awal');
    $sheet->setCellValue('E1', 'Daya Baru');

    $rowIndex = 2; // Ubah variabel $row menjadi $rowIndex untuk indeks baris

    $no = 1;
    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowIndex, $no++);
        $sheet->setCellValue('B' . $rowIndex, $row['nama']);
        $sheet->setCellValue('C' . $rowIndex, $row['alamat']);
        $sheet->setCellValue('D' . $rowIndex, $row['daya']);
        $sheet->setCellValue('E' . $rowIndex, $row['daya_baru']);
        $rowIndex++; // Tambahkan peningkatan indeks baris
    }

    // Membuat file Excel
    $writer = new Xlsx($spreadsheet);
    $tempExcelFile = tempnam(sys_get_temp_dir(), 'excel');
    $writer->save($tempExcelFile);

    return $tempExcelFile;
}

$query = "SELECT * FROM tb_33";

if (isset($_POST['download'])) {
    $result = mysqli_query($conn, $query);
    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    $tempExcelFile = exportToExcel($data);

    // Mengirim file Excel ke browser
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="data_penyambungan.xlsx"');
    header('Cache-Control: max-age=0');
    readfile($tempExcelFile);
    unlink($tempExcelFile); // Hapus file Excel sementara setelah diunduh
    exit();
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id'];

    // Menghapus data dari tb_33 berdasarkan id
    $delete_query = "DELETE FROM tb_33 WHERE id = '$id'";
    mysqli_query($conn, $delete_query);

    // Mengarahkan kembali ke halaman ini setelah selesai menghapus
    header("Location: smbng.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Pasang Baru</title>
</head>
<body>
    <div class="container">
        <h1>Data Penyambungan</h1>
        <div class="wrp">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Daya Awal</th>
                        <th>Daya Baru</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['daya']; ?></td>
                                <td><?= $row['daya_baru']; ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button type="submit" name="selesai" class="btn btn-danger">Selesai</button>
                                    </form>
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
            <div class="show">
                <button onclick="location.href='indeks.php'" class="btn btn-secondary">BACK</button>
            </div>
            <form method="post">
                <button type="submit" name="download" class="btn btn-primary">Download Data</button>
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
