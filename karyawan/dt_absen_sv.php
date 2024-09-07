<?php
include '../koneksi.php';
if (isset($_POST['simpan'])) 
{
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $keterangan_masuk = $_POST['keterangan_masuk'];

    $check = "SELECT waktu_masuk, waktu_keluar FROM tb_absen WHERE id_karyawan = '$id_karyawan' AND waktu_keluar is null";
    $result = mysqli_query($koneksi, $check);

    // Periksa apakah query berhasil dijalankan atau tidak
    if (!$result) {
        die('Error: ' . mysqli_error($koneksi));
    }

    // Menggunakan fungsi mysqli_num_rows untuk mendapatkan jumlah baris yang dikembalikan oleh query
    if (mysqli_num_rows($result) == 0) 
    {
        $save = "INSERT INTO tb_absen SET id_karyawan='$id_karyawan', nama='$nama', waktu_masuk='$waktu_masuk', keterangan_masuk='$keterangan_masuk', keterangan_keluar='$keterangan_masuk'";
        mysqli_query($koneksi, $save);
        echo "<script>alert('Anda berhasil Absen Masuk') </script>";
        echo "<script>window.location.href = \"index.php?m=awal\" </script>";

    } 
    else
    {
        $update = "UPDATE tb_absen SET waktu_keluar='$waktu_masuk',keterangan_keluar='$keterangan_masuk' WHERE waktu_keluar is null AND id_karyawan ='$id_karyawan'";
        mysqli_query($koneksi, $update);
        echo "<script>alert('Anda berhasil Absen Keluar') </script>";
        echo "<script>window.location.href = \"index.php?m=awal\" </script>";
    }
}
?>
