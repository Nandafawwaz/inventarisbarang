<?php
require 'function.php';
require 'cek.php';
?>

<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <style>
        .navbar-brand img {
        max-width: 80px; /* Set the maximum width of the image */
        height: auto; /* Automatically adjust the height while maintaining the aspect ratio */
        margin-right: 10px; /* Optional: Add some spacing between the image and the text */
    }
        .navbar {
        background-image: url('assets/img/navbar.png'); /* Replace with the actual path to your background image */
        background-size: cover; /* Adjust how the image covers the background */
        background-repeat: no-repeat; /* Prevent the background image from repeating */
        }
        </style>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
<a class="navbar-brand" href="keluar.php">
        <img src="assets/img/bjb.png" alt="Logo" class="logo-img">
    </a>
        </nav>
<div class="container">
    <br>
			<h2>Stock Tersedia</h2>

            <div>
            <form method="GET" action="">
        <label>Filter by Deskripsi:</label>
        <input type="radio" name="filter" value="ATK"> ATK
        <input type="radio" name="filter" value="Cetakan"> Cetakan
        <button type="submit">Filter</button>
    </form>
</div>

<?php

$ambil_alldatastock = filterExportKeluarStockByDeskripsi($conn, '');


function filterExportKeluarStockByDateRange($conn, $startDate, $endDate) {
    $query = "SELECT * FROM keluar WHERE tanggal BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function filterExportKeluarStockByTujuan($conn, $tujuan) {
    $query = "SELECT * FROM keluar WHERE tujuan = '$tujuan'";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>
<div>

<form method="GET" action="">
    <label for="start-date">Start Date:</label>
    <input type="date" id="start-date" name="start-date">
    
    <label for="end-date">End Date:</label>
    <input type="date" id="end-date" name="end-date">
    
    <button type="submit">Filter</button>
</form>
<form method="GET" style="float:right">
<label for="tujuan">Filter by Tujuan:</label>
<select name="tujuan" class="form-control" required>
<option value="" <?php echo ($location == '')?"selected":"" ?>>All Location</option>
                                        <option value="Cabang Tangerang Selatan" <?php echo ($location == 'Cabang Tangerang Selatan')?"selected":"" ?>>Cabang Tangerang Selatan</option>
                                        <option value="KCP Alam Sutera" <?php echo ($location == 'KCP Alam Sutera')?"selected":"" ?>>KCP Alam Sutera</option>
                                        <option value="KCP Bintaro Jaya" <?php echo ($location == 'KCP Bintaro Jaya')?"selected":"" ?>>KCP Bintaro Jaya</option>
                                        <option value="KCP Bintaro" <?php echo ($location == 'KCP Bintaro')?"selected":"" ?>>KCP Bintaro</option>
                                        <option value="KCP Cirendeu" <?php echo ($location == 'KCP Cirendeu')?"selected":"" ?>>KCP Cirendeu</option>
                                        <option value="KCP Ciputat" <?php echo ($location == 'KCP Ciputat')?"selected":"" ?>>KCP Ciputat</option>
                                        <option value="KCP Pamulang" <?php echo ($location == 'KCP Pamulang')?"selected":"" ?>>KCP Pamulang</option>
                                        <option value="KCP Pahlawan Seribu" <?php echo ($location == 'KCP Pahlawan Seribu')?"selected":"" ?>>KCP Pahlawan Seribu</option>
                                        <option value="KCP Serpong" <?php echo ($location == 'KCP Serpong')?"selected":"" ?>>KCP Serpong</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary" name="filter_location" style = "margin-left: 5px; margin-right: 20px">
                                    Filter Lokasi
                                 </button>
</form>
</div>
            <div class="data-tables datatable-dark">
					<br>
                    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Tujuan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
if (isset($_GET['start-date']) && isset($_GET['end-date'])) {
    $startDate = $_GET['start-date'];
    $endDate = $_GET['end-date'];
    $ambil_alldatastock = filterExportKeluarStockByDateRange($conn, $startDate, $endDate);
}

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $ambil_alldatastock = filterExportKeluarStockByDeskripsi($conn, $filter);
}
                                            $grandtotal = 0;
                                            while ($data=mysqli_fetch_array($datastockkeluar)) :
                                                $idk = $data['idkeluar'];
                                                $idb = $data['idbarang'];
                                                $tanggal = $data['tanggal_k'];
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $tujuan = $data['tujuan'];
                                                $harga = $data['harga'];
                                                $qty = $data['qty'];
                                                $total = $data['harga']*$qty;
                                                $grandtotal += $total;
                                            
                                            ?>

                                            <tr>
                                                <td><?php echo$tanggal?></td>
                                                <td><?php echo$namabarang?></td>
                                                <td><?php echo$deskripsi?></td>
                                                <td><?php echo$tujuan?></td>    
                                                <td><?php echo number_format($harga, 0, ',', '.'); ?></td>
                                                <td><?php echo number_format($qty, 0, ',', '.'); ?></td>
                                                <td><?php echo number_format($total, 0, ',', '.'); ?></td>                                        
                                            </tr>         
                            
                                                
                                            <?php 
                                                endwhile;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Grand Total</b></td>
                                                <td><b>Rp <?php echo number_format($grandtotal, 0, ',', '.'); ?></b></td>
                                            </tr> 
                                        </tfoot>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
var table =    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true },
            { extend: 'print', footer: true }
            
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>