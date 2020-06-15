<?php
$iduser = isset($_GET['user-order']) ? $_GET['user-order'] : "";
$madh = isset($_GET['madh']) ? $_GET['madh'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>PizzaHot - Checkout</title>
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
</head>

<body class="goto-here">
	<?php
	include('modules/header.php');
	include('modules/content/title.php'); //tieu de & hinh nen tieu de

	if ($iduser != "") {
		$account = DataProvider::executeQuery("SELECT * FROM taikhoan WHERE IDUSER = '$iduser' LIMIT 1");
		$re = mysqli_fetch_assoc($account);
	} else {
		$re['NAME'] = "";
		$re['ADDRESS'] = "";
		$re['PHONE'] = "";
		$re['EMAIL'] = "";
 	}
	echo $madh;
	if ($madh != "") {
		$order = DataProvider::executeQuery("SELECT * FROM donhang WHERE MADH = '$madh' LIMIT 1");
		$re_order = mysqli_fetch_assoc($order);
	} else {
		$re_order = 0;
	}
	?>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">
					<form action="#" class="billing-form" id="bill-form">
						<h3 class="mb-4 billing-heading">Chi tiết thanh toán</h3>
						<div class="row align-items-end">
							<div class="col-md-12">
								<div class="form-group">
									<label for="streetaddress">Họ tên</label>
									<input name="name" type="text" value="<?php echo $re['NAME']; ?>" class="form-control" placeholder="Họ và tên">
								</div>
							</div>


							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="streetaddress">Địa chỉ</label>
									<input name="address" type="text" value="<?php echo $re['ADDRESS']; ?>" class="form-control" placeholder="Địa chỉ">
								</div>
							</div>



							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Số điện thoại</label>
									<input name="phone" type="text" value="<?php echo $re['PHONE']; ?>" class="form-control" placeholder="Số điện thoại">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Email</label>
									<input name="email" type="text" value="<?php echo $re['EMAIL']; ?>" class="form-control" placeholder="Email">
								</div>
							</div>

						</div>
					</form><!-- END -->
				</div>
				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-5">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Tổng chi</h3>
								<p class="d-flex">
									<span>Tổng tiền sản phẩm</span>
									<span><?php if($re_order['TONGTIEN'] !=0 ) echo ($re_order['TONGTIEN'] - 15.000); ?></span>
								</p>
								<p class="d-flex">
									<span>Phí giao</span>
									<span>15.000 VNĐ</span>
								</p>
								<p class="d-flex">
									<span> Giảm giá</span>
									<span>0 VNĐ</span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Tổng</span>
									<span><?php echo ($re_order['TONGTIEN']); ?></span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="cart-detail p-3 p-md-4">
								<h3 class="billing-heading mb-4">Phương thức thanh toán</h3>

								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" checked name="optradio" class="mr-2"> Thanh toán khi nhận hàng</label>
										</div>
									</div>
								</div>

								<p><a href="#" id="submit-checkout" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section> <!-- .section -->
	<?php include('admin/alertModal.php'); ?>
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

	<script>
		$('.nav-item-shop').addClass("active");
	</script>

	<script>
		var madh = '<?php echo $madh; ?>';
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
		$('#submit-checkout').on('click', function(e) {
			var x = $('#bill-form').serializeArray();
			x.push({
				'name': 'madh',
				'value': madh
			});
			x.push({
				'name': 'order-action',
				'value': 'update-detail'
			})
			$.ajax({
				type: "POST",
				url: "handle-user.php",
				data: x,
				success: function(result) {
					$('#alertModal .modal-body p').html("Xác nhận thanh toán thành công <br> Nhấn OK để về trang chủ!");
					$('#alertModal').modal('show');
				}
			});
			console.log(JSON.stringify(x));
		});
		$('#alertModal').on('hidden.bs.modal', function(e) {
			location.href = 'index.php';
		})
	</script>

</body>

</html>