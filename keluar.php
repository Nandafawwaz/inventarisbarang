<?php
require 'function.php';
require 'cek.php';

if(isset($_POST['filter'])){
                $location = $_POST['location'];
                if($location==""){
                $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
                }else{
                $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang AND tujuan='$location'");
                }     
}else{
     $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
     $location="";
}
        
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
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Inventaris Bank BJB</a>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: left;">
                                    Tambah Barang
                                </button>
                                <form action="keluar.php" method="post" style="float:right">
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
                                    <button type="submit" class="btn btn-primary" name="filter">
                                    Filter Lokasi
                                 </button>
                                 </form>
                                 
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Tujuan</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
                                            $i = 1;
                                            $grandtotal = 0;
                             
                                            while ($data=mysqli_fetch_array($ambil_alldatastock)) {
                                                $idk = $data['idkeluar'];
                                                $idb = $data['idbarang'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $tujuan = $data['tujuan'];
                                                $qty = $data['qty'];
                                                $total = $data['harga']*$qty;
                                                $grandtotal += $total;
                                            
                                            ?>

                                            <tr>
                                                <td><?= $tanggal?></td>
                                                <td><?=$namabarang?></td>
                                                <td><?=$tujuan?></td>                                              
                                                <td><?=$qty ?></td> 
                                                <td><?=$total?></td> 
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
                                                <td colspan="4" align="center"><b>Grand Total</b></td>
                                                <td align="left"><b>Rp <?=$grandtotal?></b></td>
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
            <select name="item_barang" class="form-control">
                <?php
                    $ambil_data = $conn->query("SELECT * FROM stock");
                    while ($fetcharray = mysqli_fetch_array($ambil_data)) :
                        $nama = $fetcharray['namabarang'];
                        $id_barang = $fetcharray['idbarang'];
                    ?>
                        <option value="<?=$id_barang?>"><?=$nama?></option>
                    <?php endwhile; ?>
            </select>
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
