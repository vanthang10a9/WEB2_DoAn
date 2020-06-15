<?php
$cur_year = date('Y');
$cur_month = date('m');
$s_monthlyIssue = "SELECT MONTH(NGAYNHAP) as thang, SUM(TONGTIEN) as tt 
                    FROM DONNHAP 
                    WHERE year(NGAYNHAP) = '$cur_year'
                    GROUP BY thang";
$run_monthlyIssue = DataProvider::executeQuery($s_monthlyIssue);
$months = array();
$monthlyIssues = array();
for ($i = 1; $i <= 12; $i++) {
  array_push($months, "Tháng " . $i);
  $monthlyIssues[$i] = 0;
}
while ($monthlyIssue = mysqli_fetch_assoc($run_monthlyIssue)) {
  $monthlyIssues[$monthlyIssue['thang']] = $monthlyIssue['tt'];
  $rowIssues[] = $monthlyIssue;
}
$monthlyIssues = array_values($monthlyIssues);

//
$s_lastMonthIssue = "SELECT MONTH(NGAYNHAP) as thang, SUM(TONGTIEN) as tt 
                      FROM DONNHAP 
                      WHERE year(NGAYNHAP) = $cur_year AND month(NGAYNHAP) = ($cur_month - 1)
                      GROUP BY thang";
$run_lastMonthIssue = DataProvider::executeQuery($s_lastMonthIssue);
$lastMonthIssue = mysqli_fetch_assoc($run_lastMonthIssue);
//
$s_currentYearIssue = "SELECT YEAR(NGAYNHAP) as y, SUM(TONGTIEN) as tt 
                      FROM DONNHAP 
                      WHERE year(NGAYNHAP) = $cur_year
                      GROUP BY y";
$run_currentYearIssue = DataProvider::executeQuery($s_currentYearIssue);
$currentYearIssue = mysqli_fetch_assoc($run_currentYearIssue);

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
$s_out_of_stock = "SELECT * FROM sanpham WHERE SOLUONGSP < 10 AND DUYET = 2";
$run_out_of_stock = DataProvider::executeQuery($s_out_of_stock);
$count_products = mysqli_num_rows($run_out_of_stock);

//---------------------------
$s_unaccept_recept = "SELECT * FROM donnhap WHERE DUYET = 0";
$run_unaccept_recept = DataProvider::executeQuery($s_unaccept_recept);
$count_recept = mysqli_num_rows($run_unaccept_recept);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <a href="" id="export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thống kê nhập hàng</a>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tiền nhập hàng (Tháng <?php echo ($cur_month -1); ?>)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ($lastMonthIssue['tt']); ?> VNĐ</div>
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
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng tiền nhập (Năm <?php echo $cur_year; ?>)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $currentYearIssue['tt']; ?> VNĐ</div>
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
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sản phầm gần hết hàng</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $count_products; ?></div>
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
          <th>Tổng tiền</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rowIssues as $row) : array_map('htmlentities', $row); ?>
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

<script src="vendor/jquery/jquery.table2excel.js"></script>
  <script type="text/javascript" charset="utf-8">
    var months = <?php echo json_encode($months); ?>;
    var monthlyIssues = <?php echo json_encode($monthlyIssues); ?>;
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
          data: monthlyIssues,
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
        filename: "nhap_hang_nam", //do not include extensi
        fileext: ".xls", // file extension
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true,
      });
    });
  </script>