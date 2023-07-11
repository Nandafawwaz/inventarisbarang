<?php
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost","root","","inventaris_db");

// Menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $jumlah * $harga;


    $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, keterangan, harga, jumlah, total) values('$namabarang','$deskripsi','$keterangan','$harga','$jumlah','$total')");
    if ($addtotable) {
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');
    }
}

// Menampilkan isi kolom "total"
$result = mysqli_query($conn, "SELECT total FROM stock");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['total'] . "<br>";
}

// Menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $item_barang = $_POST['item_barang'];
    $penerima = $_POST['penerima'];
    $tanggal = $_POST['tanggal'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$item_barang'");
    $ambil_data = mysqli_fetch_array($cekstocksekarang);

    $currentstock = $ambil_data['jumlah'];
    $tambahstock = $currentstock+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, penerima, tanggal, qty) values('$item_barang','$penerima','$tanggal','$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set jumlah ='$tambahstock' where idbarang='$item_barang'");
    if ($addtomasuk && $updatestockmasuk) {
        header('location:masuk.php');

    }else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

// Menambah barang keluar
if (isset($_POST['barangkeluar'])) {
    $item_barang = $_POST['item_barang'];
    $tujuan = $_POST['tujuan'];
    $tanggal = $_POST['tanggal'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$item_barang'");
    $ambil_data = mysqli_fetch_array($cekstocksekarang);

    $currentstock = $ambil_data['jumlah'];
    $tambahstock = $currentstock-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, tujuan, tanggal, qty) values('$item_barang','$tujuan','$tanggal','$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set jumlah='$tambahstock' where idbarang='$item_barang'");
    if ($addtokeluar && $updatestockmasuk) {
        header('location:keluar.php');

    }else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

?>