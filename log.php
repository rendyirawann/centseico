<!-- Eksekusi Form Login -->
<?php 
require "koneksi.php";
        if(isset($_POST['submit'])) {
          $user = $_POST['username'];
          $password = $_POST['password'];

          // Query untuk memilih tabel
          $cek_data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' AND password = '$password'");
          $hasil = mysqli_fetch_array($cek_data);
          $status = $hasil['status'];
          $login_user = $hasil['username'];
          $row = mysqli_num_rows($cek_data);

          // Pengecekan Kondisi Login Berhasil/Tidak
            if ($row > 0) {
                session_start();   
                $_SESSION['login_user'] = $status;

                if ($status == 'admin') {
                  header('location: index.php');
                }elseif ($status == 'user') {
                  header('location: index.php'); 
                }
            }else{
                header("location: login.php");
            }
        }
       ?>