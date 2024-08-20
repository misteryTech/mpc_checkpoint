<?php
include("admin_header.php");
?>
<body>

<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<?php
    include("admin_topnav.php");
    include("admin_sidenav.php");

    $licensed_no = isset($_GET['licensed_no']) ? $_GET['licensed_no'] : '';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Review Licensed ID: <?php echo htmlspecialchars($licensed_no); ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active">Review Violations</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row align-items-top">
      <div class="col-lg-12 mb-4">
      <?php
          if ($licensed_no) {
              // Prepare SQL to fetch all records with matching license number
              $stmt = $connection->prepare("SELECT * FROM traffic_violations WHERE driver_licensed = ?");
              $stmt->bind_param('s', $licensed_no);
              $stmt->execute();
              $result = $stmt->get_result();
              $count = 1;

              if ($result->num_rows > 0) {
                  // Display data in a DataTable
                  echo '<table id="violationsTable" class="display">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>License Number</th>
                                  <th>Violation Type</th>
                                  <th>Status</th>
                                  <th>Violation Date</th>
                                  <th>Driver Image</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>';

                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>".$count."</td>";
                      echo "<td>".$row['driver_firstname']."</td>";
                      echo "<td>".$row['driver_lastname']."</td>";
                      echo "<td>".$row['driver_licensed']."</td>";
                      echo "<td>".$row['violation_type']."</td>";
                      echo "<td>".$row['status']."</td>";
                      echo "<td>".$row['violation_date']."</td>";
                      echo "<td><img src='process/" . htmlspecialchars($row['driver_image_path']) . "' alt='Driver Image' style='width: 50px; height: 50px;'></td>";
                      echo "<td class='d-flex'>";
                      echo "<a class='btn btn-primary me-2' href='edit_violation.php?violation_id=" . htmlspecialchars($row['violation_id']) . "'>Edit</a>";
                      echo "<a class='btn btn-danger me-2' href='delete_violation.php?violation_id=" . htmlspecialchars($row['violation_id']) . "'>Delete</a>";
                      echo "</td>";
                      echo "</tr>";

                      $count++;
                  }

                  echo '</tbody></table>';
              } else {
                  // Display No Violation Certificate
                  echo '<div id="noViolationCertificate" class="certificate" style="display:none;">
                          <h2>No Violation Certificate</h2>
                          <p>This is to certify that the driver with License Number <strong>' . htmlspecialchars($licensed_no) . '</strong> has no recorded violations in our system.</p>
                          <p>Release Date: <span id="certificateDate">[DATE]</span></p>
                          <p><strong>Authorized Signatory</strong></p>
                          <p>______________________________</p>
                        </div>';

                  // Date input and Print button
                  echo '<div class="form-group mb-3">
                          <label for="certificateDateInput">Select Date</label>
                          <input type="date" id="certificateDateInput" class="form-control" required>
                        </div>';
                  echo '<button onclick="printCertificate()" class="btn btn-primary">Print Certificate</button>';
              }

              $stmt->close();
          } else {
              echo '<p>Please provide a license number to search.</p>';
          }

          $connection->close();
        ?>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
    include("admin_footer.php");
?>

<!-- Include jQuery and DataTables script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

<script>
  $(document).ready(function() {
      $('#violationsTable').DataTable(); // Initialize DataTable
  });

  function printCertificate() {
      var selectedDate = document.getElementById('certificateDateInput').value;
      var certificate = document.getElementById('noViolationCertificate');
      var originalContents = document.body.innerHTML;

      if (!selectedDate) {
          alert('Please select a date before printing.');
          return;
      }

      // Update the certificate release date
      document.getElementById('certificateDate').innerText = selectedDate;
      certificate.style.display = 'block'; // Show the certificate

      // Update status and release date in the database
      $.ajax({
          url: 'process/update_status.php',
          method: 'POST',
          data: {
              licensed_no: '<?php echo $licensed_no; ?>',
              release_date: selectedDate,
              status: 'Verified'
          },
          success: function(response) {
              if (response.success) {
                  alert('Status updated to Verified.');
              }

              // Print the certificate
              var printContents = certificate.innerHTML;
              document.body.innerHTML = printContents;
              window.print();
              document.body.innerHTML = originalContents;
          },
          error: function() {
              alert('Error updating status.');
          }
      });
  }
</script>

<style>
  .certificate {
      text-align: center;
      border: 2px solid #000;
      padding: 20px;
      width: 70%;
      margin: 20px auto;
      font-family: Arial, sans-serif;
  }

  .certificate h2 {
      margin-bottom: 30px;
  }

  .certificate p {
      margin-bottom: 20px;
  }
</style>

</body>
</html>
