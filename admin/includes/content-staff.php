<?php
header('location: wait-accept.php');
$cur_year = date('Y');
$cur_month = date('m');
$s_monthlyIncome = "SELECT MONTH(NGAYDH) as thang, SUM(TONGTIEN) as tt 
                    FROM DONHANG 
                    WHERE year(NGAYDH) = $cur_year
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

