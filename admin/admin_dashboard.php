<?php
    include("admin_header.php");

?>
<body>

     <!-- ======= Header ======= -->
     <!-- ======= Sidebar ======= -->
<?php
    include("admin_topnav.php");
    include("admin_sidenav.php");




    $stmt_query = $connection->prepare("SELECT COUNT(*) as count FROM profiles");
    $stmt_query->execute();
    $stmt_result  = $stmt_query->get_result();
    $stmt_result_count = $stmt_result->fetch_assoc()['count'];




    $violation_query =  $connection->prepare("SELECT  COUNT(*) as count_violation FROM traffic_violations");
    $violation_query->execute();
    $violation_result = $violation_query->get_result();
    $violation_result_count = $violation_result->fetch_assoc()['count_violation'];




    $release_query = $connection->prepare("SELECT COUNT(*) as count_release FROM profiles WHERE status='verified'");
    $release_query->execute();
    $release_result = $release_query->get_result();
    $release_result_count = $release_result->fetch_assoc()['count_release'];
?>



  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Request <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $stmt_result_count; ?></h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">



                <div class="card-body">
                  <h5 class="card-title">Violation <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $violation_result_count; ?></h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">



                <div class="card-body">
                  <h5 class="card-title">Release <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $release_result_count; ?></h6>


                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
    include("admin_footer.php");
?>