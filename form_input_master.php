<?php
include "koneksi.php";
$query2 = mysqli_query ($con, "SELECT MAX(kode_produk) AS kode_produk FROM `barang`");
$getMaxID = mysqli_fetch_array($query2);

if(isset($_POST['submit'])) {
    $nama_produk = $_POST['nama'];
    $harga_produk = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $kategori = $_POST['kategori'];
    $url_gambar = $_POST['gambar'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO `barang` (`kode_produk`, `nama_produk`, `harga_produk`, `satuan`, `kategori`, `url_gambar`, `stock`) VALUES (NULL, '$nama_produk', $harga_produk, '$satuan', '$kategori', '$url_gambar', $stock)";

    mysqli_query($con, $sql);
    header('location: form_input_master.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>From input master</title>
</head>
<style>
    .container{
        width: 70%;
        margin-top: 20px;
    }
    td{
        color: black;
        font-size: 20px;
    }
    button{
        cursor: pointer;
        background: blue;
        color: white;
        border-radius: 10px;
        /* border: none; */
        width: 100px;
    }
    input,select{
        width: 100%;
        border-radius:10px;
        padding-left: 10px;
        border-color: rgb(0, 234, 255);
    }
    ::placeholder{
        text-align: center;
    }
    th{
        color: rgb(0, 234, 255);
    }
    table{
        color:white;
    }
    .bg-red{
        background: red;
        color: white;
    }
</style>
<body>
    <div class="container">
        <table class="table" border="7px">
            <form action="" method="post">
            <tr>
                <td colspan="2"><center><h2>From Input Master Dan Stock Data Barang</h2></center></td>
            </tr>

            <tr>
                <td>Kode Produk</td>
                <td><input type="text" value="<?=($getMaxID['kode_produk']+1) ?>" disabled></td>
                <input type="hidden" name="kode_produk" value="<?= ($getMaxID['kode_produk']+1) ?>">
            </tr>

            <tr>
                <td>Nama Produk</td>
                <td><input type="text" name="nama"></td>
            </tr>

            <tr>
                <td>Harga Produk</td>
                <td><input type="number" name="harga"></td>
            </tr>

            <tr>
                <td>Satuan</td>
                <td>
                    <select name="satuan" id="">
                        <option value="Gelas">Gelas</option>
                        <option value="Piring">Piring</option>
                        <option value="Mangkok">Mangkok</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Kategori</td>
                <td>
                    <select name="kategori" id="">
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Snack">Snack</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>URL Gambar</td>
                <td><input type="url" name="gambar" id=""></td>
            </tr>

            <tr>
                <td>Stock Awal</td>
                <td><input type="number" name="stock"></td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" value="simpan" name="submit"></td>
            </tr>
            </form>
        </table>
    </div>
    <br>
    <center>
    <table border="5px" cellspacing="0" style="width:90%;">
        <tr style="text-align: center;">
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Satuan</th>
            <th>Kategori</th>
            <th>Url Gambar</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>

        <?php 
        $query = mysqli_query($con, "SELECT * FROM `barang` ");
        foreach ($query as $data) :
        ?>
        <tr>
        <td><?= $data['kode_produk'] ?></td>
        <td><?= $data['nama_produk'] ?></td>
        <td><?= $data['harga_produk'] ?></td>
        <td><?= $data['satuan'] ?></td>
        <td><?= $data['kategori'] ?></td>
        <td><img src="<?= $data['url_gambar'] ?>" alt="poto" width="150px"></td>
        <td <?php if ($data['stock']<= 5) : ?> style="background-color: red; color: white" <?php endif; ?> ><?=$data['stock'] ?></td>
        <td><a href="deletebarang.php?kode_produk=<?= $data['kode_produk'] ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
    </table>
    </center>
</body>
</html>