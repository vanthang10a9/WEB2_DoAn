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
			</div>


			<div class="row">
				<?php

				//khai báo các biến để tìm kiếm
				$category = isset($_GET['category']) ? $_GET['category'] : null;

				$condition = "";
				if (!is_null($category))
					$condition .= " AND MACL = $category";


				//thuật toán phân trang -  Nguồn: https://freetuts.net/thuat-toan-phan-trang-voi-php-va-mysql-550.html
				//tìm số records
				$result = DataProvider::executeQuery("SELECT count(MACL) AS total FROM sanpham WHERE '1' = '1'" . $condition);
				$row = mysqli_fetch_assoc($result);
				$total_records = $row['total'];

				//tìm limit, current_page
				$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
				$limit = 8;

				//tính total_page, start
				$total_page = ceil($total_records / $limit);
				//giới hạn current_page
				if ($current_page > $total_page) {
					$current_page = $total_page;
				} else if ($current_page < 1) {
					$current_page = 1;
				}
				//start
				$start = ($current_page - 1) * $limit;

				//lấy dánh sách sản phẩm
				$sql = "SELECT * FROM sanpham WHERE '1' = '1' AND DUYET = 2 " . $condition . " LIMIT $start, $limit";
				$result = DataProvider::executeQuery($sql);
				if ($result != null) {
					while ($row = mysqli_fetch_array($result)) { ?>
						<div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
								<a href="product-single.php?id=<?php echo $row['MASP']; ?>" class="img-prod"><img class="img-fluid" src="images/products/<?php echo $row['HINHANHSP']; ?>" alt="Colorlib Template">
									<?php if (!empty($row['KMSP'])) { ?><span class="status"><?php echo $row['KMSP']; ?> %</span> <?php } ?>
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3 text-center">
									<h3><a href="product-single.php?id=<?php echo $row['MASP']; ?>"><?php echo $row['TENSP']; ?></a></h3>
									<div class="d-flex">
										<div class="pricing">
											<p class="price">
												<?php
														if (!empty($row['KMSP'])) {
															$price = $row['GIASP'] - ($row['GIASP'] * $row['KMSP']) / 100; ?>
													<span class="mr-2 price-dc"><?php echo $row['GIASP']; ?> Đ</span>
												<?php
														} else {
															$price = $row['GIASP'];
														}
														?>
												<span class="price-sale"><?php echo $price; ?> Đ</span>
											</p>
										</div>
									</div>
									<div class="bottom-area d-flex px-3 product-id-<?php echo $row['MASP']; ?>" id="<?php echo $row['MASP']; ?>">
										<div class="m-auto d-flex">
											<a href="product-single.php?id=<?php echo $row['MASP']; ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center">
												<span><i class="ion-ios-menu"></i></span>
											</a>
											<a href="" class="buy-now d-flex justify-content-center align-items-center mx-1" id="addcart-<?php echo $row['MASP']; ?>">
												<span><i class="ion-ios-cart"></i></span>
											</a>
											<!-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
												<span><i class="ion-ios-heart"></i></span>
											</a> -->
										</div>
									</div>
									<script type="text/javascript">
										var mount;
										$("a#addcart-<?php echo $row['MASP']; ?>").click(function(e) {
											e.preventDefault();
											var item = {
												'id': $(".product-id-<?php echo $row['MASP'] ?>").attr('id'),
												'quantity': 1
											};
											$.ajax({
												type: "POST",
												url: "addcart.php",
												data: item,
												cache: false,
												success: function(results) {
													//console.log(data);
													mount = $('#header-amount-cart').html();
													$('#header-amount-cart').html(Number(mount) + 1);
													console.log(results);
													//window.location.reload();
												}
											});
										});
									</script>
								</div>
							</div>
						</div>
				<?php }
				} ?>
			</div>
			<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<?php
							//hiển thị nút prev
							if ($current_page > 1 && $total_page > 1) { ?>
								<li><a href="shop.php?page=<?php echo ($current_page - 1); ?>">&lt;</a></li>
								<?php
								}
								for ($i = 1; $i < $total_page; $i++) {
									if ($i == $current_page) { ?>
									<li class="active"><span><?php echo $i; ?></span></li>
								<?php } else { ?>
									<li><a href="shop.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php }
								}

								if ($current_page < $total_page && $total_page > 1) { ?>
								<li><a href="shop.php?page=<?php echo ($current_page + 1); ?>">&gt;</a></li>
							<?php }
							?>
						</ul>
					</div>
				</div>
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
	<script src="js/main.js"></script>
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