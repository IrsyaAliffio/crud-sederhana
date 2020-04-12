<?php

include "koneksi.php";

if(isset($_GET['kode_produk'])) {
    $kode_produk = $_GET['kode_produk'];
    $sql = mysqli_query($con, "DELETE FROM `barang` WHERE kode_produk = '$kode_produk'");
    header('location: form_input_master.php');
}
?>
