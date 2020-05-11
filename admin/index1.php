<?php
include('includes/head.php');
$cur_year = date('Y');
$cur_month = date('m');
$s_monthlyIncome = "SELECT MONTH(NGAYDH) as thang, SUM(TONGTIEN) as tt 
                    FROM DONHANG 
                    WHERE year(NGAYDH) = '$cur_year'
                    GROUP BY thang";
$run_monthlyIncome = DataProvider::executeQuery($s_monthlyIncome);
$months = array();
$monthlyIncomes = array();
for ($i = 1; $i <= 12; $i++) {
  array_push($months, "Tháng " . $i);
  $monthlyIncomes[$i] = 0;
}
while ($monthlyIncome = mysqli_fetch_assoc($run_monthlyIncome)) {
  $monthlyIncomes[$monthlyIncome['thang']] = $monthlyIncome['tt'];
  $rowIncomes[] = $monthlyIncome;
}
$monthlyIncomes = array_values($monthlyIncomes);

//
$s_lastMonthIncome = "SELECT MONTH(NGAYDH) as thang, SUM(TONGTIEN) as tt 
                      FROM DONHANG 
                      WHERE year(NGAYDH) = $cur_year AND month(NGAYDH) = ($cur_month - 1)
                      GROUP BY thang";
$run_lastMonthIncome = DataProvider::executeQuery($s_lastMonthIncome);
$lastMonthIncome = mysqli_fetch_assoc($run_lastMonthIncome);
//
$s_currentYearIncome = "SELECT YEAR(NGAYDH) as y, SUM(TONGTIEN) as tt 
                      FROM DONHANG 
                      WHERE year(NGAYDH) = $cur_year
                      GROUP BY y";
$run_currentYearIncome = DataProvider::executeQuery($s_currentYearIncome);
$currentYearIncome = mysqli_fetch_assoc($run_currentYearIncome);

//
$s_categories = "SELECT SUM(SOLUONGSP) as sl, TENCL 
                  FROM sanpham sp
                  INNER JOIN loaisanpham lsp ON sp.MACL = lsp.MACL
                  GROUP BY TENCL";
$run_categories = DataProvider::executeQuery($s_categories);

function rand_color()
{
  return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

while ($product_categories = mysqli_fetch_assoc($run_categories)) {
  $arrs[] = $product_categories;
}
foreach ($arrs as &$obj) {
  $color = array("color" => rand_color());
  $obj = array_merge($obj, $color);
  //print_r($obj);
}
//print_r($arrs);
//---------------------------
$s_unactive_user = "SELECT * FROM taikhoan WHERE LEVEL = 0 AND DUYET = 0";
$run_unactive_user = DataProvider::executeQuery($s_unactive_user);
$count_user = mysqli_num_rows($run_unactive_user);

//---------------------------
$s_unaccept_recept = "SELECT * FROM donnhap WHERE DUYET = 0";
$run_unaccept_recept = DataProvider::executeQuery($s_unaccept_recept);
$count_recept = mysqli_num_rows($run_unaccept_recept);
?>



<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('includes/topbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="" id="export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thống kê doanh thu</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doanh thu (Tháng <?php echo ($lastMonthIncome['thang']); ?>)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ($lastMonthIncome['tt']); ?> VNĐ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng doanh thu (Năm <?php echo $cur_year; ?>)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $currentYearIncome['tt']; ?> VNĐ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tài khoản chưa duyệt</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $count_user; ?></div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đơn nhập chưa duyệt</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_recept; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Doanh thu năm <?php echo $cur_year ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myCustomChart"></canvas>
                  </div>
                </div>
              </div>
            </div>


            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Số lượng sản phẩm theo danh mục</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myCPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <?php
                    foreach ($arrs as &$obj) { ?>
                      <span class="mr-2">
                        <i class="fas fa-circle" style="color:<?php echo $obj['color']; ?>"></i> <?php echo $obj['TENCL']; ?>
                      </span>
                    <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
            </div>

            <div style="display:none">
              <table id="tablez">
                <thead>
                  <tr>
                    <th>Tháng</th>
                    <th>Doanh thu</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rowIncomes as $row) : array_map('htmlentities', $row); ?>
                    <tr>
                      <td><?php echo implode('</td><td>', $row); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('includes/footer.php'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php
  include('includes/scroll-logout.php');
  include('includes/scripts.php');
  ?>
  <script src="vendor/jquery/jquery.table2excel.js"></script>
  <script type="text/javascript" charset="utf-8">
    var months = <?php echo json_encode($months); ?>;
    var monthlyIncomes = <?php echo json_encode($monthlyIncomes); ?>;
    //set chart
    var ctx = document.getElementById("myCustomChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: "Doanh thu",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: monthlyIncomes,
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return '$' + number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
  </script>

  <script>
    var num_products = [];
    var categories = [];
    var colors = [];
    <?php
    foreach ($arrs as &$obj) { ?>
      num_products.push("<?php echo $obj['sl']; ?>");
      categories.push("<?php echo $obj['TENCL']; ?>")
      colors.push("<?php echo $obj['color']; ?>")
    <?php
    }
    ?>
    //alert(categories);
    var ctx = document.getElementById("myCPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: categories,
        datasets: [{
          data: num_products,
          backgroundColor: colors,
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

    $("a#export").click(function() {
      //export report
      $("#tablez").table2excel({
        // exclude CSS class
        name: "Worksheet Name",
        exclude: ".noExp",
        filename: "doanh_thu_nam", //do not include extensi
        fileext: ".xls", // file extension
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true,
      });
    });
  </script>
</body>

</html>