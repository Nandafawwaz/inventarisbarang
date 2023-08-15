<?php
require 'function.php';
require 'cek.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <style>
        .sb-nav-link-icon img {
        max-width: 130px; 
        height: auto; 
        margin-right: 100px;
        margin-left: 45px; 
        margin-top: 410px;
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
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="admin.php">
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>

                            <div class="sb-nav-link-icon">
                            <img src="assets/img/bjb.png" alt="Icon 2">
                           </div>

                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Barang Keluar</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: left; margin-right: 4px;">
                                    Tambah Barang
                                </button>
                                <a href="export_keluar.php" class="btn btn-info">Export Tabel</a>
                                <form id="descForm" method="post" style="float:right">
                                    <select name="desc_kl" id="desc_kl">
                                        <option value="" <?php echo ($desc_kl == '')?"selected":"" ?>>All Deskripsi</option>
                                        <option value="ATK" <?php echo ($desc_kl == 'ATK')?"selected":"" ?>>ATK</option>
                                        <option value="Cetakan" <?php echo ($desc_kl == 'Cetakan')?"selected":"" ?>>Cetakan</option>
                            
                                    </select>
                                    <button type="submit" class="btn btn-primary" name="filter_desc_kl" style="margin-left: 5px">
                                    Filter Deskripsi
                                 </button>
                                 </form>
                                <form id="locationForm" method="post" style="float:right">
                                    <select name="location" id="location">
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
                                 
                                <br>
                                <div class="row mt-4">
                                 <div class="col">
                                 <form id="dateForm" method ="post" class="form-inline">
                                    <input type ="date" name ="tgl_mulai1" class="form-control">
                                    <input type ="date" name ="tgl_selesai1" class="form-control ml-3">
                                    <button type ="submit" name="filter_tgl_kl" class="btn btn-info ml-3">
                                    Filter
                                    </button>

                                 </form>  
                                 </div>
                                 </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Tujuan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                            while ($data=mysqli_fetch_array($datastockkeluar)) {
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
                                                <td><?=$tanggal?></td>
                                                <td><?=$namabarang?></td>
                                                <td><?=$deskripsi?></td>
                                                <td><?=$tujuan?></td>    
                                                <td><?php echo number_format($harga, 0, ',', '.'); ?></td>
                                                <td><?php echo number_format($qty, 0, ',', '.'); ?></td>
                                                <td><?php echo number_format($total, 0, ',', '.'); ?></td> 
                                                <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                            Edit
                                                        </button>
                                                        <input type ="hidden" name ="idbaranghapus" value = "<?=$idb;?>">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                            Delete
                                                        </button>
                                                </td>                                         
                                            </tr>         
                                            
                                            <!-- Edit Modal -->                                           
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <select name="tujuan" class="form-control" required>
                                                    <option value="">Tujuan</option>
                                                    <option value="Cabang Tangerang Selatan">Cabang Tangerang Selatan</option>
                                                    <option value="KCP Alam Sutera">KCP Alam Sutera</option>
                                                    <option value="KCP Bintaro Jaya">KCP Bintaro Jaya</option>
                                                    <option value="KCP Bintaro">KCP Bintaro</option>
                                                    <option value="KCP Cirendeu">KCP Cirendeu</option>
                                                    <option value="KCP Ciputat">KCP Ciputat</option>
                                                    <option value="KCP Pamulang">KCP Pamulang</option>
                                                    <option value="KCP Pahlawan Seribu">KCP Pahlawan Seribu</option>
                                                    <option value="KCP Serpong">KCP Serpong</option>
                                                </select>
                                                <br>
                                                <input type="date" name="tanggal" value="<?$tanggal;?>" class="form-control" required>
                                                
                                                <br>
                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                <br>
                                                <br>
                                                <input type ="hidden" name ="idb" value = "<?=$idb;?>">
                                                <input type ="hidden" name ="idk" value = "<?=$idk;?>">
                                                <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                </div>
                                                </form>
                                                
                                                
                                            </div>
                                            </div>
                                        </div>    

                                            <!-- Delete Modal -->                                           
                                            <div class="modal fade" id="delete<?=$idk;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Hapus <?=$namabarang;?> ?
                                                <br>
                                                <br>
                                                <input type ="hidden" name ="idb" value = "<?=$idb;?>">
                                                <input type ="hidden" name ="kty" value = "<?=$qty;?>">
                                                <input type ="hidden" name ="idk" value = "<?=$idk;?>">
                                                <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                </div>
                                                </form>
                                                
                                                
                                            </div>
                                            </div>
                                        </div> 

                                            <?php 
                                            };
                                            ?>
                                            
                                            <tr>
                                                <td colspan="6" align="center"><b>Grand Total</b></td>
                                                <td><b>Rp <?php echo number_format($grandtotal, 0, ',', '.'); ?></b></td>
                                                <!-- <td></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script type="text/javascript">
            function showPrice(str) {
                if (str == "") {
                    document.getElementById("price").innerHTML = "";
                    return;
                } else { 
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("price").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","function.php?price="+str,true);
                    xmlhttp.send();
                }
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
    document.addEventListener("DOMContentLoaded", function() {
        const locationForm = document.getElementById("locationForm");
        const descForm = document.getElementById("descForm");
        const dateForm = document.getElementById("dateForm");

        locationForm.addEventListener("submit", function(event) {
            event.preventDefault();
            // Submit location form
            this.submit();
        });

        descForm.addEventListener("submit", function(event) {
            event.preventDefault();
            // Submit description form
            this.submit();
        });

        dateForm.addEventListener("submit", function(event) {
            event.preventDefault();
            // Submit date form
            this.submit();
        });
    });
</script>
    </body>
    
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <select name="item_barang" class="select2 " onchange="showPrice(this.value)">
    <?php
    $ambil_data = $conn->query("SELECT * FROM keluar k, stock s GROUP BY namabarang");
    while ($fetcharray = mysqli_fetch_array($ambil_data)) :
        $nama = $fetcharray['namabarang'];
        $id_barang = $fetcharray['idbarang'];
        $harga = $fetcharray['harga'];
    ?>
        <option value="<?=$id_barang?>"><b><?=$nama?></b> - Rp <?=number_format($harga, 0, ',', '.')?></option>
    <?php endwhile; ?>
</select>
          <br>
          <br>
          <select name="tujuan" class="form-control" required>
            <option value="">Tujuan</option>
            <option value="Cabang Tangerang Selatan">Cabang Tangerang Selatan</option>
            <option value="KCP Alam Sutera">KCP Alam Sutera</option>
            <option value="KCP Bintaro Jaya">KCP Bintaro Jaya</option>
            <option value="KCP Bintaro">KCP Bintaro</option>
            <option value="KCP Cirendeu">KCP Cirendeu</option>
            <option value="KCP Ciputat">KCP Ciputat</option>
            <option value="KCP Pamulang">KCP Pamulang</option>
            <option value="KCP Pahlawan Seribu">KCP Pahlawan Seribu</option>
            <option value="KCP Serpong">KCP Serpong</option>
          </select>
          <br>
          <input type="date" name="tanggal" class="form-control" required>
          <br>
          <input type="number" name="qty" placeholder="Stock" class="form-control" required>
          <br>
          <br>
          <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</html>

