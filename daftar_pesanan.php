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
								<h1 class="mb-10" style="color:white;">Data Pemesanan Pelanggan</h1>
							</div>
						</div>
                        <div class="row d-flex justify-content-center">
                        <table class="table table-bordered" id="example" style="color:white;">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
			<th scope="col">Nama Pemesan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Total Bayar</th>
			<th scope="col">Status</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php 
            $ambil = mysqli_query($koneksi, 'SELECT * FROM pemesanan');
            $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
          ?>
          <?php foreach($result as $result) : ?>

          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $result["id_pemesanan"]; ?></td>
			<td><?php echo $result["nama_pemesan"]; ?></td>
            <td><?php echo $result["tanggal_pemesanan"]; ?></td>
            <td>Rp. <?php echo number_format($result["total_belanja"]); ?></td>
			<td><span class="badge badge-warning"><?php echo $result["status"]; ?></span></td>
            <td>
              
              <a href="detail_pesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="badge badge-primary">Detail</a>
             

              <a href="hapus_detailpesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="badge badge-danger">Hapus Data</a>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
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