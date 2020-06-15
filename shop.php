<!DOCTYPE html>
<html lang="en">

<head>
	<title>PizzaHot - Shop</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- css search -->
	<link rel="stylesheet" href="css/search.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


</head>

<body class="goto-here">
	<?php
	include('modules/header.php');
	include('modules/content/title.php'); //tieu de & hinh nen tieu de
	?>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 mb-5 text-center">
					<ul class="product-category">
						<li><a href="shop.php" class="active" id="all">Tất cả</a></li>
						<?php
						$categoryGet = isset($_GET['category']) ? $_GET['category'] : null;
						$result = DataProvider::executeQuery("SELECT * FROM loaisanpham");
						while ($row = mysqli_fetch_assoc($result)) {
							$category = $row['TENCL'];
							$categoryId = $row['MACL'];
							?>
							<li><a id="<?php echo $categoryId; ?>" href="shop.php?category=<?php echo $categoryId; ?>"><?php echo $category; ?></a></li>

						<?php
						}
						?>
					</ul>
				</div>
				<div class="col-md-10 mb-5">
					<div class="search" ><input type="search" placeholder="Search" class="search_sp" id="search"></div>
					<div class="p-2 ">Khoảng giá : </div>
					<div class=" d-flex flex-row">
						<div class="p-2 "><input type="number" class="search_sp" id="minPrice"></div>
						<div class="p-2 "><input type="number" class="search_sp" id="maxPrice"></div>
					</div>
				</div>
			</div>

			<div id="data" style="text-align: center;">
				<?php include("getData.php") ?>
			</div>
		</div>
	</section>

	<?php include('modules/content/subcribe.php'); ?>

	<?php include('modules/footer.php'); ?>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/ajax.js"></script>
	<script src="js/main.js"></script>

	<script src="js/search.js"></script>

	<script type="text/javascript" charset="utf-8">
		var categorySelect = "<?php echo $category; ?>" != "" ? "<?php echo $category; ?>" : "all";
		$(document).ready(function() {
			$('li a').removeClass('active');
			$("li a#" + categorySelect + "").addClass('active');
		});

		$('.nav-item-shop').addClass('active');
	</script>


</body>

</html>
<style>
	.img-fluid {
		max-width: 100%;
		max-height: 170px;
	}
</style>