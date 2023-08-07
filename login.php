<?php
    
    require "function.php";

    if (isset($_POST['login'])) {
        $username=$_POST['username'];
        $password = md5($_POST["password"]);

        $query=mysqli_query($conn, "SELECT * FROM login WHERE username='$username' and password='$password'");     
        $cek=mysqli_num_rows($query);

        if ($cek>0) {
            $_SESSION['log']='True';
            $_SESSION['username']=$username;
            header("location:stock.php");
        } else {
            header("location:index.php?pesan=gagal");
        };

    };

    if (!isset($_SESSION['log'])) {
        
    } else {
        header('location:stock.php');
    };
    

?>