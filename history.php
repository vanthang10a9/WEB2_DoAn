<?php
include('admin/alertModal.php');
if (!isset($_SESSION)) {
	session_start();
}
//print_r($_SESSION);
//xử lý khi người dùng chỉnh sửa đơn hàng

//kiểm tra giỏ hàng có tồn tại sản phẩm
// $ok = 1;
// if (isset($_SESSION['cart'])) {
// 	foreach ($_SESSION['cart'] as $k => $v) {
// 		if (isset($k))
// 			$ok = 2;
// 	}
// }
//check đăng nhập mới bấm giỏ hàng
$ok_user = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>PizzaHot - Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

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
	$ok = 1;
	if (isset($_SESSION['username'])) {
		$USERNAME = $_SESSION['username'];
		$account = DataProvider::executeQuery("SELECT * FROM taikhoan WHERE USERNAME = '$USERNAME' LIMIT 1");
		$re = mysqli_fetch_assoc($account);
		$uid = $re['IDUSER'];
		if ($re['LEVEL'] != '0') {
			$ok_user = 1;
		} else {
			$ok_user = 2;
		}

		$orders = DataProvider::executeQuery("SELECT * FROM donhang WHERE IDUSER = '$uid' LIMIT 1");
		//$ress = mysqli_fetch_assoc($orders);
		if (mysqli_num_rows($orders) > 0) {
			$ok = 2;
		}
	}
	?>
	<div class="modal fade" id="ordermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table-bordered" width="100%" cellspacing="0" id="detailz">
						<thead class="thead-primary">
							<tr>
								<th>&nbsp;</th>
								<th>Tên sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<?php
					if ($ok == 2) {
						?>
						<div class="cart-list">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Tên</th>
										<th>Địa chỉ</th>
										<th>Số điện thoại</th>
										<th>Tổng tiền</th>
										<th>Thời gian đặt</th>
										<th class="noExp">Chi tiết</th>
										<!-- <th>Nhân viên</th> -->
										<th>Trạng thái</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "SELECT dh.*, tk.USERNAME FROM donhang dh INNER JOIN taikhoan tk ON dh.MANV = tk.IDUSER WHERE dh.IDUSER = '$uid'";
										$result = DataProvider::executeQuery($sql);
										while ($row = mysqli_fetch_assoc($result)) {
											switch ($row['STATUS']) {
												case 0:
													$trangthai = "Chưa tiếp nhận";
													break;
												case 1:
													$trangthai = "Hoàn thành";
													break;
												default:
													$trangthai = "Chưa tiếp nhận";
											}
											?>
											<tr id="<?php echo $row['MADH']; ?>">
												<td><?php echo $row['NAME']; ?></td>
												<td><?php echo $row['ADDRESS']; ?></td>
												<td><?php echo $row['PHONE']; ?></td>
												<td><?php echo number_format($row['TONGTIEN'],0,".",".")." Đ"; ?></td>
												<td><?php echo $row['NGAYDH']; ?></td>
												<td class="noExp"><button class="btn btn-outline-primary m-1 ct">Chi tiết</button></td>
												<!-- <td><?php echo $row['USERNAME']; ?></td> -->
												<td id="<?php echo $row['STATUS']; ?>"><?php echo $trangthai; ?></td>
											</tr>

										<?php } ?>
								</tbody>
								<tfoot>
								</tfoot>
							</table>
						</div>
				</div>
				<div class="row justify-content-end">
					<!-- Phần khuyến mại + thanh toán: thương mại điện tử làm -->
					<!-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Coupon Code</h3>
						<p>Enter your coupon code if you have one</p>
						<form action="#" class="info">
							<div class="form-group">
								<label for="">Coupon code</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
						</form>
					</div>
					<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
				</div>
				<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Estimate shipping and tax</h3>
						<p>Enter your destination to get a shipping estimate</p>
						<form action="#" class="info">
							<div class="form-group">
								<label for="">Country</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
							<div class="form-group">
								<label for="country">State/Province</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
							<div class="form-group">
								<label for="country">Zip/Postal Code</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
						</form>
					</div>
					<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Estimate</a></p>
				</div> -->
					
				</div>
			</div>
		<?php } else { ?>
			<p>Lịch sử mua hàng trống</p>
		<?php } ?>
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

	<script>
		$('.nav-item-cart').addClass("active");
	</script>

	<script>
		var okUser = '<?php echo $ok_user; ?>';
		var updateTotal = function() {
			var sumtotal = 0;
			$(".total").each(function() {
				sumtotal += Number($(this).html());
			});
			$('#sumtotal').html(sumtotal);
			$('#sumtotalz').html(Number(sumtotal) + 15000);
		}
		$('.quantityi').on('change', function(e) {
			var selector = $(this).closest('tr');
			var price = selector.find('.price').html();
			var total = selector.find('.total');
			var quantity = $(this).val();
			var result = Number(quantity) * Number(price);
			total.html(result);
			updateTotal();
			e.preventDefault();
			//alert(total);
			//alert($(this).val());
		});
		$('#dataTable tbody').on('click', '.ct', function(e) {
			var id = $(this).closest('tr').attr('id');
			var x = {
				'action-dh': 'select-detail',
				'id': id
			};


			console.log(JSON.stringify(x));
			$.ajax({
				type: "POST",
				url: "handle-user.php",
				data: x,
				success: function(results) {
					$('#detailz tbody').html(results);
				}
			});
			$("#ordermodal").modal("show");
			e.preventDefault();
		});
	</script>

</body>

</html>