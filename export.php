<?php

include 'koneksi.php';

$sql = "SELECT * FROM tb_absen";
$query = mysqli_query($koneksi, $sql);

$header = array('Nip', 'Nama', 'Waktu Masuk', 'Waktu Keluar', 'Keterangan');

$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data[] = array($row['id_karyawan'], $row['nama'], $row['waktu_masuk'], $row['waktu_keluar'], $row['keterangan_masuk'], $row['keterangan_keluar']);
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=data_absen.xls');

echo '<table border="1">';
echo '<tr>';
foreach ($header as $value) {
    echo '<th>' . $value . '</th>';
}
echo '</tr>';

foreach ($data as $row) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

?>
