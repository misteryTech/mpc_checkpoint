<?php include("admin_header.php"); ?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");


        $sql = "SELECT patrol_id, patrol_basename FROM patrol_base_tbl LIMIT 10";
        $result = $connection->query($sql);

        $patrolbase_name = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $patrolbase_name[] = $row;
            }
        }





    ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Vehicle Traffic Violation Form</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Traffic Violation</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Report a Vehicle Traffic Violation</h5>

          <form action="process/encode_registration_violation.php" method="post" enctype="multipart/form-data" class="row g-3">

            <div class="col-md-6">
              <label for="officer_name" class="form-label">Patrol Based ID</label>
              <select name="patrol_base" id="patrol_base" class="form-select" onchange="updateCustomerInfo()">
                                        <option value="" selected>Select Customer</option>
                                        <?php foreach ($patrolbase_name as $patrol_name) : ?>
                                            <option value="<?php echo htmlspecialchars($patrol_name['patrol_id']); ?>">
                                                <?php echo htmlspecialchars($patrol_name['patrol_basename']); ?>
                                            </option>
                                        <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
              <label for="violation_type" class="form-label">Violation Type</label>
              <select class="form-select" id="violation_type" name="violation_type" required>
                <option value="">Select a violation</option>
                <option value="speeding">Speeding</option>
                <option value="illegal_parking">Illegal Parking</option>
                <option value="reckless_driving">Reckless Driving</option>
                <option value="drunk_driving">Drunk Driving</option>
                <option value="running_red_light">Running a Red Light</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="vehicle_plate_number" class="form-label">Vehicle Plate Number</label>
              <input type="text" class="form-control" id="vehicle_plate_number" name="vehicle_plate_number" required>
            </div>

            <div class="col-md-6">
              <label for="driver_name" class="form-label">Driver Name</label>
              <input type="text" class="form-control" id="driver_name" name="driver_name" required>
            </div>

            <div class="col-md-6">
              <label for="violation_location" class="form-label">Violation Location</label>
              <input type="text" class="form-control" id="violation_location" name="violation_location" required>
            </div>

            <div class="col-md-3">
              <label for="date" class="form-label">Date of Violation</label>
              <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="col-md-3">
              <label for="time" class="form-label">Time of Violation</label>
              <input type="time" class="form-control" id="time" name="time" required>
            </div>

            <div class="col-md-6">
              <label for="evidence" class="form-label">Upload Evidence (if any)</label>
              <input type="file" class="form-control" id="evidence" name="evidence">
            </div>

            <div class="col-md-12">
              <label for="additional_notes" class="form-label">Additional Notes</label>
              <textarea class="form-control" id="additional_notes" name="additional_notes" rows="4"></textarea>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Submit Violation</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php include("admin_footer.php"); ?>
