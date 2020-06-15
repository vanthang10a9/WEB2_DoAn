<?php
include('includes/head.php');
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
        <?php // trang index đầu có nội dung cho mỗi quyền khác nhau nên cần có đoạn này
          if ($re['LEVEL'] == 3)
            include('includes/content-admin.php');
          if ($re['LEVEL'] == 2)
            include('includes/content-manager.php');
          if ($re['LEVEL'] == 1)
            include('includes/content-staff.php');
        ?>
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
  
</body>

</html>