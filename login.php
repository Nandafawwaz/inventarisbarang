<?php
     session_start();   
    include "function.php";

        $username=$_POST['username'];
        $password = ($_POST["password"]);
        $enpass=md5($password);

        $query=mysqli_query($conn, "SELECT * FROM login WHERE username='$username' and password='$enpass'");

        $cek=mysqli_num_rows($query);

        if ($cek>0) {
            $_SESSION['log']='True';
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            header("location:stock.php");
        } else {
            header("location:index.php?pesan=gagal");
        };
if(!isset($_SESSION['log'])){

} else {
    header("location:stock.php");
};

?>