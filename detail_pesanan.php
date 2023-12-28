<?php 
    include('koneksi.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>CENTSEICO - Coffee</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
		integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/menu.css">
</head>

<body>

	<header id="header" id="home">
		<div class="header-top">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
						<ul>
							<li>
								Mon-Fri: 8am to 2pm
							</li>
							<li>
								Sat-Sun: 11am to 4pm
							</li>
							<li>
								<a href="tel:(012) 6985 236 7512">(012) 6985 236 7512</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
				</div>
				<nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="index.php">Home</a></li>
				          <li><a href="index.php#about">About</a></li>
				          <li><a href="index.php#coffee">Coffee</a></li>
				          <li><a href="index.php#review">Review</a></li>
				          <li><a href="index.php#blog">Blog</a></li>

						  <?php if(isset($_SESSION['login_user']) && $_SESSION['login_user']== 'admin') //check if user is a admin and display drop item
    {
    ?> 
						  <li><a href="logout.php" class="btn btn-danger">Log Out</a></li>
						  <li><a href="daftar_pesanan.php"><i class="fa fa-cart-plus" aria-hidden="true"></i> Order History</a></li>
						  <li><a href="daftar_menu.php"><i class="fa fa-file-o" aria-hidden="true"></i> +Manage Menu</a></li>
						  <?php  }elseif(isset($_SESSION['login_user']) && $_SESSION['login_user']== 'user') // if user is not logged in then display these buttons
                                {
                                    ?>
	<li><a href="logout.php" class="btn btn-danger">Log Out</a></li> 
	<li><a href="menu_pembeli.php"><i class="fa fa-cart-plus" aria-hidden="true"></i> Order</a></li>
						  <?php  }else{ // if user is not logged in then display these buttons?>
							<li><a href="login.php" class="btn btn-primary">Login</a></li>
							
							<?php } ?> 
				        </ul>
				      </nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header><!-- #header -->
    
    <!-- Start menu Area -->
			<section class="menu-area section-gap" id="coffee">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10" style="color:white;">Data Order</h1>
							</div>
						</div>
                        <div class="row d-flex justify-content-center">
                        <table class="table table-bordered" id="example" style="color:white;">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
			<th scope="col">Nama Pemesan</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $totalbelanja = 0; ?>
          <?php 
              $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu 
                WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
           ?>
           <?php while ($pecah=$ambil->fetch_assoc()) { ?>
           <?php $subharga1=$pecah['harga']*$pecah['jumlah']; ?>
          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $pecah['id_pemesanan_produk']; ?></td>
			<td><?php echo $pecah['nama_pemesan']; ?></td>
            <td><?php echo $pecah['nama_menu']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
              Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php $totalbelanja+=$subharga1; ?>
          <?php } ?>
        </tbody>
         <tfoot>
          <tr>
            <th colspan="5">Total Bayar</th>
            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
      
      <form method="POST" action="">
	  <div class="form-group">
          <label for="menu1">Konfirmasi Nama Pemesan</label>
          <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
        </div>
        <a href="daftar_pesanan.php" class="btn btn-success btn-sm">Kembali</a>
        <button class="btn btn-primary btn-sm" name="bayar">Konfirmasi Pembayaran</button>
      </form>  
      <?php 
        if(isset($_POST["bayar"]))
        {
			$tanggal_pemesanan=date("Y-m-d");
		  $nama_pemesan = $_POST['nama_pemesan'];

          // Menyimpan data ke tabel pemesanan
          $insert = mysqli_query($koneksi, "INSERT INTO pemesanan (nama_pemesan, tanggal_pemesanan, total_belanja, status) VALUES ('$nama_pemesan', '$tanggal_pemesanan', '$totalbelanja', 'berhasil')");

          // Mendapatkan ID barusan
          $id_terbaru = $koneksi->insert_id;

          echo "<script>alert('Pesanan Telah Dibayar !');</script>";
		  $id = $_GET['id'];
          $del = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan='$id'");

          
          echo "<script>location= 'daftar_pesanan.php'</script>";
        }
      ?>
                        </div>
					</div>														
				</div>
			</section>
			<!-- End menu Area -->
	


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="js/easing.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script src="js/waypoints.min.js"></script>
	<script src="js/jquery.counterup.min.js"></script>
	<script src="js/mail-script.js"></script>
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
		crossorigin="anonymous"></script>
</body>

</html>