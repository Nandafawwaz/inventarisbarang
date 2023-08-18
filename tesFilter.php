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
    if($mulai !=null && $selesai !=null){
        $datastock = mysqli_query($conn,"SELECT * FROM  stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastock;
    } 
    $datastock = mysqli_query($conn, "SELECT * FROM stock");
    return $datastock; 

    
}

function filterStockByAll($conn,$desc,$mulai,$selesai){
    if($desc != "" && $mulai !=null && $selesai !=null){
        $datastock = mysqli_query($conn,"SELECT * FROM  stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) AND deskripsi='$desc'");
        return $datastock;
    }
    else if($mulai !=null || $selesai !=null){
        $datastock = mysqli_query($conn,"SELECT * FROM  stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastock;
    } 
    else if ($desc != "") {
        $datastock = mysqli_query($conn, "SELECT * FROM stock WHERE deskripsi='$desc'");
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
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM  keluar k, stock s WHERE (s.idbarang = k.idbarang) and (k.tanggal_k >= '$mulai' AND k.tanggal_k<= '$selesai')");
        return $datastockkeluar;
    } 
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM  keluar k, stock s WHERE s.idbarang = k.idbarang ");
        return $datastockkeluar;
}

function filterKeluarStockByAll($conn, $location, $mulai, $selesai, $desc_kl){
    if($location != "" && $mulai != null && $selesai != null && $desc_kl != ""){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tujuan = '$location' AND keluar.tanggal_k BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) AND stock.deskripsi = '$desc_kl'");
        return $datastockkeluar;
    }
    else if ($location != "" && $mulai != null && $selesai != null) {
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tujuan = '$location' AND keluar.tanggal_k BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastockkeluar;
    } 
    else if ($location != "" && $desc_kl != "") {
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tujuan = '$location' AND stock.deskripsi = '$desc_kl'");
        return $datastockkeluar;
    }
    else if ($mulai != null && $selesai != null && $desc_kl != "") {
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tanggal_k BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) AND stock.deskripsi = '$desc_kl'");
        return $datastockkeluar;
    }
    else if($desc_kl != ""){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE stock.deskripsi = '$desc_kl'");
        return $datastockkeluar;
    }
    else if ($location != "") {
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tujuan = '$location'");
        return $datastockkeluar;
    }
    else if ($mulai != null && $selesai != null) {
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE keluar.tanggal_k BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastockkeluar;
    }

    $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang");
    return $datastockkeluar;
}

function filterStockByAll($conn, $mulai, $selesai, $desc){

    if ($mulai != null && $selesai != null && $desc != "") {
        $datastock = mysqli_query($conn,"SELECT * FROM stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) AND deskripsi = '$desc'");
        return $datastock;
    }
    else if($desc != ""){
        $datastock = mysqli_query($conn,"SELECT * FROM stock WHERE deskripsi = '$desc'");
        return $datastock;
    }
    else if ($mulai != null && $selesai != null) {
        $datastock = mysqli_query($conn,"SELECT * FROM stock WHERE tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
        return $datastock;
    }

    $datastock = mysqli_query($conn,"SELECT * FROM stock");
    return $datastock;
}

function filterKeluarStockByDeskripsi($conn, $desc_kl){
    if($desc_kl != ""){
        $datastockkeluar = mysqli_query($conn,"SELECT * FROM keluar INNER JOIN stock ON keluar.idbarang = stock.idbarang WHERE stock.deskripsi = '$desc'");
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

function filterExportStockByDeskripsi($conn, $desc){
    if ($desc === "ATK" || $desc === "Cetakan") {
        $ambil_alldatastock = mysqli_query($conn,  "SELECT * FROM stock WHERE deskripsi LIKE '%$desc%'");
        return $ambil_alldatastock;
    }
    $ambil_alldatastock = mysqli_query($conn, "SELECT * FROM stock");
    return $ambil_alldatastock; 
}

function filterExportKeluarStockByBulan($conn, $month){
    if ($month != "") {
        $ambil_alldatastock = mysqli_query($conn,  "SELECT * FROM stock WHERE  MONTH(tanggal_k) = '$month'");
        return $ambil_alldatastock;
    }
    
    $ambil_alldatastock = mysqli_query($conn, "SELECT * FROM stock");
    return $ambil_alldatastock; 
}