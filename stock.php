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
        <title>Sistem Persediaan bjb</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
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
                            <a class="nav-link" href="stock.php">
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
                        <h1 class="mt-4">Inventaris Bank BJB</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                 </button>
                                 <a href="export.php" class="btn btn-info">Export Tabel</a>
                                 <form action="index.php" method="post" style="float:right">
                                    <select name="desc" id="desc">
                                        <option value="" <?php echo ($desc == '')?"selected":"" ?>>All Deskripsi</option>
                                        <option value="ATK" <?php echo ($desc == 'ATK')?"selected":"" ?>>ATK</option>
                                        <option value="Cetakan" <?php echo ($desc == 'Cetakan')?"selected":"" ?>>Cetakan</option>
                            
                                    </select>
                                    <button type="submit" class="btn btn-primary" name="filter_desc">
                                    Filter Deskripsi
                                 </button>
                                 </form>
                                 <br>

                                 <div class="row mt-4">
                                 <div class="col">
                                 <form method ="post" class="form-inline">
                                    <input type ="date" name ="tgl_mulai" class="form-control">
                                    <input type ="date" name ="tgl_selesai" class="form-control ml-3">
                                    <button type ="submit" name="filter_tgl_st" class="btn btn-info ml-3">
                                    Filter
                                    </button>

                                 </form>  
                                 </div>
                                 </div>
                            </div>
                            <div class="card-body">

                            <?php 
                                $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM stock where jumlah <= 10");

                                while ($fetch=mysqli_fetch_array($ambil_alldatastock)) :
                                    $barang = $fetch['namabarang'];

                            ?>

                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Perhatian!</strong> Stock <?= $barang?> Hampir Habis!
                            </div>

                            <?php 
                            
                                endwhile;
                            
                            ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Keterangan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 


                                            $i = 1;
                                            $grand_total = 0;
                                            while ($data=mysqli_fetch_array($datastock)) :
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $keterangan = $data['keterangan'];
                                                $harga = $data['harga'];
                                                $jumlah = $data['jumlah'];
                                                $total = $data['total'];
                                                $idb = $data['idbarang'];
                                                $grand_total += $total;
                                                $tanggal = $data['tanggal'];

                                            ?>
    
                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?=$namabarang?></td>
                                                <td><?=$deskripsi?></td>
                                                <td><?=$keterangan ?></td>
                                                <td><?=$harga?></td>
                                                <td><?=$jumlah ?></td>
                                                <td><?=$total ?></td>
                                                <td><?= $tanggal?></td>
                                                <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                            Edit
                                                        </button>
                                                        <input type ="hidden" name ="idbaranghapus" value = "<?=$idb;?>">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                            Delete
                                                        </button>
                                                </td>
                                            </tr>      
                                            
                                            <!-- Edit Modal -->                                           
                                            <div class="modal fade" id="edit<?=$idb;?>">
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
                                                <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                <br>
                                                <select name="deskripsi" class="form-control" required>
                                                    <option value="">Pilih Deskripsi</option>
                                                    <option value="ATK">ATK</option>
                                                    <option value="Cetakan">Cetakan</option>
                                                </select>
                                                <br>
                                                <select name="keterangan" class="form-control" required>
                                                    <option value="">Keterangan</option>
                                                    <option value="bk">bk</option>
                                                    <option value="buku">buku</option>
                                                    <option value="pack">pack</option>
                                                    <option value="pcs">pcs</option>
                                                    <option value="roll">roll</option>
                                                    <option value="dus">dus</option>
                                                    <option value="rim">rim</option>
                                                    <option value="lusin">lusin</option>
                                                    <option value="set">set</option>

                                                </select>
                                                <br>
                                                <input type="number" name="harga" value="<?=$harga;?>" class="form-control" required>
                                                <br>
                                                <input type="number" name="jumlah" value="<?=$jumlah?>" class="form-control" required>
                                                <br>
                                                <input type="date" name="tanggal" value="<?$tanggal;?>" class="form-control" required>
                                                <br>
                                                <br>
                                                <input type ="hidden" name ="idb" value = "<?=$idb;?>">
                                                <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                </div>
                                                </form>
                                                
                                                
                                            </div>
                                            </div>
                                        </div>    

                                            <!-- Delete Modal -->                                           
                                            <div class="modal fade" id="delete<?=$idb;?>">
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
                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>    

                                            </tr>         
                                            
                                            <?php 
                                                endwhile;
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center"><b>Grand Total</b></td>
                                                <td align="left"><b>Rp <?=$grand_total?></b></td>
                                                <td></td>
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
        <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <select name="deskripsi" class="form-control" required>
            <option value="">Pilih Deskripsi</option>
            <option value="ATK">ATK</option>
            <option value="Cetakan">Cetakan</option>
          </select>
          <br>
          <select name="keterangan" class="form-control" required>
            <option value="">Keterangan</option>
            <option value="bk">bk</option>
            <option value="buku">buku</option>
            <option value="pack">pack</option>
            <option value="pcs">pcs</option>
            <option value="roll">roll</option>
            <option value="dus">dus</option>
            <option value="rim">rim</option>
            <option value="lusin">lusin</option>
            <option value="set">set</option>

          </select>
          <br>
          <input type="number" name="harga" placeholder="Harga" class="form-control" required>
          <br>
          <input type="number" name="jumlah" placeholder="Stock" class="form-control" required>
          <br>
          <input type="date" name="tanggal" class="form-control" required>
          <br>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
        </div>
        </form>
        
        
      </div>
    </div>
  </div>
</html>