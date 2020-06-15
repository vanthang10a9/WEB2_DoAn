<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    var url = window.location.pathname;
    var pageURL = url.substring(url.lastIndexOf('/') + 1);
    var a = 'a[href*="' + pageURL+ '"]';
    $(a).addClass('active');
    $('div:has('+a+')').addClass('show');
    $('li:has('+a+')').addClass('active');
  });
</script>