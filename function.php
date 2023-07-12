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
    $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$item_barang'");
    if ($addtomasuk && $updatestockmasuk && $updatetotal) {
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
    $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$item_barang'");
    if ($addtokeluar && $updatestockmasuk && $updatetotal) {
        header('location:keluar.php');

    }else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}


    //Update info barang
    if (isset($_POST['updatebarang'])) {
        $idb = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];
        $keterangan = $_POST['keterangan'];
        $harga = $_POST['harga'];
        
        $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi', keterangan='$keterangan', harga='$harga' where idbarang='$idb'");
        $updatestock = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$idb'");
        $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$item_barang'");
        if ($update && $updatestock && $updatetotal) {
            header('location:index.php');
    
        }else {
            echo 'Gagal';
            header('location:index.php');
        }
    }

    //Hapus barang
    if (isset($_POST['hapusbarang'])) {
        $idb = $_POST['idb'];

        $hapus = mysqli_query($conn,"delete from stock where idbarang='$idb'");
        if ($hapus) {
            header('location:index.php');
    
        }else {
            echo 'Gagal';
            header('location:index.php');
        }
    }

    //Edit barang masuk
    if (isset($_POST['updatebarangmasuk'])) {   
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];

        $tanggal = $_POST['tanggal'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn, "select * from stock where idbarang ='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['jumlah'];

        $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk ='$idm'"); 
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];
        
        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg - $selisih;
            $kurangistock = mysqli_query($conn, "update stock set jumlah ='$kurangin' where idbarang = '$idb'");
            $updatenya = mysqli_query($conn, "update masuk set qty='$qty', tanggal ='$tanggal', penerima ='$penerima' where idmasuk ='$idm'");
            $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$idb'");
            if($kurangistock && $updatenya && $updatetotal){
                header('location:masuk.php');
    
            }else {
                echo 'Gagal';
                header('location:masuk.php');
            }
        } else {
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg + $selisih;
            $kurangistock = mysqli_query($conn, "update stock set jumlah ='$kurangin' where idbarang = '$idb'");
            $updatenya = mysqli_query($conn, "update masuk set qty='$qty', tanggal ='$tanggal', penerima ='$penerima' where idmasuk ='$idm'");
            $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$idb'");
            if($kurangistock && $updatenya && $updatetotal){
                header('location:masuk.php');
    
            }else {
                echo 'Gagal';
                header('location:masuk.php');
            }
        }
    }

    // Menghapus barang masuk
    if(isset($_POST['hapusbarangmasuk'])) {   
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang ='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "update stock set jumlah ='$selisih' where idbarang ='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");
    $updatetotal = mysqli_query($conn,"update stock set total = jumlah * harga where idbarang='$idb'");

    if($update && $hapusdata && $updatetotal){
        header('location:masuk.php');
    }else {
        header('location:masuk.php');
    }

}

    //Edit barang keluar
    if (isset($_POST['updatebarangkeluar'])) {   
        $idb = $_POST['idb'];
        $idk = $_POST['idk'];

        $tanggal = $_POST['tanggal'];
        $tujuan = $_POST['tujuan'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn, "select * from stock where idbarang ='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['jumlah'];

        $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar ='$idk'"); 
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];
        
        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg - $selisih;
            $kurangistock = mysqli_query($conn, "update stock set jumlah ='$kurangin' where idbarang = '$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', tanggal ='$tanggal', tujuan ='$tujuan' where idkeluar ='$idk'");

            if($kurangistock&&$updatenya){
                header('location:keluar.php');
    
            }else {
                echo 'Gagal';
                header('location:keluar.php');
            }
        } else {
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg + $selisih;
            $kurangistock = mysqli_query($conn, "update stock set jumlah ='$kurangin' where idbarang = '$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', tanggal ='$tanggal', tujuan ='$tujuan' where idkeluar ='$idk'");

            if($kurangistock&&$updatenya){
                header('location:keluar.php');
    
            }else {
                echo 'Gagal';
                header('location:keluar.php');
            }
        }
    }

        // Menghapus barang keluar
        if(isset($_POST['hapusbarangkeluar'])) {   
            $idb = $_POST['idb'];
            $qty = $_POST['kty'];
            $idk = $_POST['idk'];
    
        $getdatastock = mysqli_query($conn, "select * from stock where idbarang ='$idb'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];
    
        $selisih = $stok+$qty;
    
        $update = mysqli_query($conn, "update stock set jumlah ='$selisih' where idbarang ='$idb'");
        $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");
    
        if($update&&$hapusdata){
            header('location:keluar.php');
        }else {
            header('location:keluar.php');
        }
    
    }
?>