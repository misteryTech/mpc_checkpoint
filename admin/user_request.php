<?php
    include("admin_header.php");
?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");

    ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>User Requests</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active">Requests</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row align-items-top">

    <?php
      // Fetch users with 'request' status
      $sql = "SELECT id, first_name, last_name, email, phone, driver_image, licensed_no FROM profiles WHERE status = 'request'";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
    ?>

      <div class="col-lg-3 mb-4">
        <!-- Card with user details and review button -->
        <div class="card" style="width: 18rem; height: 24rem;">
          <img src="../process/<?php echo $row['driver_image']; ?>" class="card-img-top" alt="User Image" style="object-fit: cover; height: 10rem;">
          <div class="card-body" style="overflow-y: auto;">
            <h5 class="card-title"><?php echo $row['first_name'] . " " . $row['last_name']; ?></h5>
            <p class="card-text"><strong>Licensed No.:</strong> <?php echo $row['licensed_no']; ?></p>
            <p class="card-text"><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
            <a href="review_user_page.php?licensed_no=<?php echo $row['licensed_no']; ?>" class="btn btn-primary">Review</a>
          </div>
        </div><!-- End Card with user details and review button -->
      </div>

    <?php
          }
      } else {
          echo "<p>No users with request status found.</p>";
      }
      $connection->close();
    ?>

    </div>
  </section>

</main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
        include("admin_footer.php");
    ?>

</body>
</html>
