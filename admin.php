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
                            <a class="nav-link" href="keluar_atk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar ATK
                            </a>
                            <a class="nav-link" href="keluar_cetakan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar Cetakan
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
                                    Tambah Admin
                                 </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            $ambil_alldata_admin = mysqli_query($conn,"SELECT * FROM login");
                                            $i = 1;
                                            while ($data=mysqli_fetch_array($ambil_alldata_admin)) :
                                                $user_name = $data['username'];
                                                $id_user = $data['iduser'];
                                                $pw = $data['password'];

                                            ?>

                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?=$user_name?></td>
                                                <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id_user;?>">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id_user;?>">
                                                            Delete
                                                        </button>
                                                </td>
                                            </tr>      
                                            
                                            <!-- Edit Modal -->                                           
                                            <div class="modal fade" id="edit<?=$id_user;?>">
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
                                                <input type="text" name="username_baru" value="<?=$user_name;?>" class="form-control" placeholder="Email" required>
                                                <br>
                                                <input type="password" name="password_baru" class="form-control" value="<?=$pw?>" placeholder="Password">
                                                <br>
                                                <br>
                                                <input type ="hidden" name ="iduser" value = "<?=$id_user;?>">
                                                <button type="submit" class="btn btn-primary" name="updateadmin">Submit</button>
                                                </div>
                                                </form>
                                                
                                                
                                            </div>
                                            </div>
                                        </div>    

                                            <!-- Delete Modal -->                                           
                                            <div class="modal fade" id="delete<?=$id_user;?>">
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
                                                Hapus <?=$user_name;?>?
                                                <br>
                                                <br>
                                                <input type ="hidden" name ="iduser" value = "<?=$id_user;?>">
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <input type="text" name="username" placeholder="Username" class="form-control" required>
          <br>
          <input type="password" name="password" placeholder="Password" class="form-control" required>
          <br>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
        </div>
        </form>
        
        
      </div>
    </div>
  </div>
</html>