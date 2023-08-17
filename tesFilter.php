<?php

function filterStockByDeskripsi($conn, $desc){

        if ($desc != "") {
            $datastock = mysqli_query($conn, "SELECT * FROM stock WHERE deskripsi='$desc'");
            return $datastock; 
            
        }
        $datastock = mysqli_query($conn, "SELECT * FROM stock");
        return $datastock; 
}

function filterStockByDate($conn,$mulai,$selesai){
    if($mulai !=null || $selesai !=null){
        $datastock = mysqli_query($conn,"SELECT * FROM  stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastock;
    } 
    $datastock = mysqli_query($conn, "SELECT * FROM stock");
    return $datastock; 
}

function filterKeluarStockByLokasi($conn, $location){
    if($location!=""){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang AND tujuan='$location'");
        return $datastockkeluar;                            
   }
    $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
    return $datastockkeluar;

}

function filterKeluarStockByDate($conn, $mulai, $selesai){
    if($mulai !=null || $selesai !=null){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM  keluar k, stock s WHERE (s.idbarang = k.idbarang) and (k.tanggal >= '$mulai' AND k.tanggal<= '$selesai')");
        return $datastockkeluar;
    } 
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM  keluar k, stock s WHERE s.idbarang = k.idbarang ");
        return $datastockkeluar;
}

function filterKeluarStockByDeskripsi($conn, $desc_kl){
    if($desc_kl != ""){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE stock.deskripsi = '$desc_kl'");
        return $datastockkeluar;
    }

    $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang");
    return $datastockkeluar;
}

function filterExportKeluarStockByDeskripsi($conn, $desc){
    if ($desc === "ATK" || $desc === "Cetakan") {
        $ambil_alldatastock = mysqli_query($conn,  "SELECT * FROM stock WHERE deskripsi LIKE '%$desc%'");
        return $ambil_alldatastock;
    }
    $ambil_alldatastock = mysqli_query($conn, "SELECT * FROM stock");
    return $ambil_alldatastock; 
}

function filterExportKeluarStockByBulan($conn, $month){
    if ($month != "") {
        $ambil_alldatastock = mysqli_query($conn,  "SELECT * FROM stock WHERE  MONTH(tanggal) = '$month'");
        return $ambil_alldatastock;
    }
    
    $ambil_alldatastock = mysqli_query($conn, "SELECT * FROM stock");
    return $ambil_alldatastock; 
}