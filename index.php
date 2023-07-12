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
        <title>Stock Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Sistem Inventaris Bank bjb</a>
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
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
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
                        <h1 class="mt-4">Inventaris Bank bjb</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                 </button>
                            </div>
                            <div class="card-body">
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            $ambil_alldatastock = mysqli_query($conn,"SELECT * FROM stock");
                                            $i = 1;
                                            while ($data=mysqli_fetch_array($ambil_alldatastock)) :
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $keterangan = $data['keterangan'];
                                                $harga = $data['harga'];
                                                $jumlah = $data['jumlah'];
                                                $total = $data['total'];
                                                $idb = $data['idbarang'];

                                            
                                            ?>

                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?=$namabarang?></td>
                                                <td><?=$deskripsi?></td>
                                                <td><?=$keterangan ?></td>
                                                <td><?=$harga?></td>
                                                <td><?=$jumlah ?></td>
                                                <td><?=$total ?></td>
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
          <br>
          <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
        </div>
        </form>
        
        
      </div>
    </div>
  </div>
</html>