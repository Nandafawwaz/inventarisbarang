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
        <form method="POST" action="">
        <label>Filter by Deskripsi:</label>
        <input type="radio" name="desc_kl" value="" <?= ($desc_kl == "" || $desc_kl == null) ? "checked" : "" ?>> All Desc
        <input type="radio" name="desc_kl" value="ATK" <?= $desc_kl == "ATK" ? "checked" : "" ?>> ATK
        <input type="radio" name="desc_kl" value="Cetakan" <?= $desc_kl == "Cetakan" ? "checked" : "" ?>> Cetakan
        <br>

        <label for="tgl_mulai1">Start Date:</label>
        <input type="date" id="tgl_mulai1" name="tgl_mulai1"  value = <?= $mulaiKeluar != null ? "$mulaiKeluar" : ""?>>
        
        <label for="tgl_selesai1">End Date:</label>
        <input type="date" id="tgl_selesai1" name="tgl_selesai1" value = <?= $selesaiKeluar != null ? "$selesaiKeluar" : ""?>>

        <select name="location" class="form-control">
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

        <br>

        <button type="submit" name="filter_keluar_all">Filter</button>

    </form>
</div>

<div>

</div>
            <span>Filter <?= $desc_kl?> di <?= ($location != "" ? $location : "Semua Lokasi")?> pada <?= ($mulaiKeluar != "" && $selesaiKeluar != "")? $mulaiKeluar." sampai ".$selesaiKeluar : "keseluruhan waktu" ?></span>
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

                                            
                                            $grand_total = 0;
                                            while ($data=mysqli_fetch_array($datastockkeluar)) :
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $tujuan = $data['tujuan'];
                                                $keterangan = $data['keterangan'];
                                                $harga = $data['harga'];
                                                $qty = $data['qty'];
                                                $jumlah = $data['jumlah'];
                                                $total = $data['total'];   
                                                $grand_total += $total;                
                                            ?>

                                            <tr>
                                            
                                                <td><?=$tanggal?></td>
                                                <td><?=$namabarang?></td>
                                                <td><?=$deskripsi?></td>
                                                <td><?=$tujuan?></td>    
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
                                                <td><b>Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></b></td>
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