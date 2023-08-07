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
<a class="navbar-brand" href="stock.php">
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

<div>
    <form method="GET" action="">
        <label>Filter by Month:</label>
        <select name="month" onchange="this.form.submit()">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </form>
</div>
				<div class="data-tables datatable-dark">
					
					                    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Keterangan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    if ($filter === "ATK" || $filter === "Cetakan") {
        $filter_query = "SELECT * FROM stock WHERE deskripsi LIKE '%$filter%'";
        $ambil_alldatastock = mysqli_query($conn, $filter_query);
    }
}

if (isset($_GET['month'])) {
    $month = $_GET['month'];
    $filter_query = "SELECT * FROM stock WHERE MONTH(tanggal) = '$month'";
} else {
    $filter_query = "SELECT * FROM stock";
}

$ambil_alldatastock = mysqli_query($conn, $filter_query);

                                            // $i = 1;
                                            $grand_total = 0;
                                            while ($data=mysqli_fetch_array($ambil_alldatastock)) :
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $keterangan = $data['keterangan'];
                                                $harga = $data['harga'];
                                                $jumlah = $data['jumlah'];
                                                $total = $data['total'];   
                                                $grand_total += $total;                
                                            ?>

                                            <tr>
                                                <!-- <td><?= $i++;?></td> -->
                                                <td><?php echo$tanggal?></td>
                                                <td><?php echo$namabarang?></td>
                                                <td><?php echo$deskripsi?></td>
                                                <td><?php echo$keterangan ?></td>
                                                <td><?php echo$harga?></td>
                                                <td><?php echo$jumlah ?></td>
                                                <td><?php echo$total ?></td>

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
                                                <td><b><?=$grand_total?></b></td>
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