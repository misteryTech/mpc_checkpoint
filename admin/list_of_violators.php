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

    <!-- Main -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Violator Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Manage Violators</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Violators</h5>

                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="solved-tab" data-bs-toggle="tab" data-bs-target="#solved" type="button" role="tab" aria-controls="solved" aria-selected="true">Solved</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="unsolved-tab" data-bs-toggle="tab" data-bs-target="#unsolved" type="button" role="tab" aria-controls="unsolved" aria-selected="false">Unsolved</button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="myTabContent">
                                <!-- Solved Violators Tab -->
                                <div class="tab-pane fade show active" id="solved" role="tabpanel" aria-labelledby="solved-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="solved_violators_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Patrol Base</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Violation</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $stmt = $connection->prepare("SELECT * FROM traffic_violations WHERE status = 'Solved'");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    $count = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $count . "</td>";
                                                        echo "<td>" . $row['officer_name'] . "</td>";
                                                        echo "<td>" . $row['driver_firstname'] . "</td>";
                                                        echo "<td>" . $row['violation_type'] . "</td>";
                                                        echo "<td>" . $row['violation_date'] . "</td>";
                                                        echo "<td><h5><span class='badge rounded-pill bg-success'>" . $row['status'] . "</span></h5></td>";
                                                        echo "</tr>";
                                                        $count++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><!-- End Table with hoverable rows -->
                                </div>

                                <!-- Unsolved Violators Tab -->
                                <div class="tab-pane fade" id="unsolved" role="tabpanel" aria-labelledby="unsolved-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="unsolved_violators_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Patrol Base</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Violation</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $stmt = $connection->prepare("SELECT * FROM traffic_violations WHERE status = 'Unsolved'");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    $count = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $count . "</td>";
                                                        echo "<td>" . $row['officer_name'] . "</td>";
                                                        echo "<td>" . $row['driver_firstname'] . "</td>";
                                                        echo "<td>" . $row['violation_type'] . "</td>";
                                                        echo "<td>" . $row['violation_date'] . "</td>";
                                                        echo "<td><h5><span class='badge rounded-pill bg-danger'>" . $row['status'] . "</span></h5></td>";
                                                        echo "<td>
                                                                    <div class='d-flex'>
                                                                        <button data-bs-toggle='modal' data-bs-target='#editModal" . $row['violation_id'] . "' class='btn btn-primary btn-md'>Edit</button>
                                                                    </div>
                                                                </td>";
                                                        echo "</tr>";

                                                        // Modal for Editing
                                                        echo "<div class='modal fade' id='editModal" . $row['violation_id'] . "' tabindex='-1' aria-labelledby='editModalLabel" . $row['violation_id'] . "' aria-hidden='true'>";
                                                        echo "<div class='modal-dialog'>";
                                                        echo "<div class='modal-content'>";
                                                        echo "<div class='modal-header'>";
                                                        echo "<h5 class='modal-title' id='editModalLabel" . $row['violation_id'] . "'>Edit Violation Details</h5>";
                                                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                                        echo "</div>";
                                                        echo "<div class='modal-body'>";

                                                        // Form for editing violation details
                                                        echo "<form action='process/violation_edit_process.php' method='POST'>";
                                                        echo "<input type='hidden' name='violation_id' value='" . $row['violation_id'] . "'>";

                                                        // Displaying the image
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='driver_image" . $row['violation_id'] . "'>Driver Image</label>";
                                                        echo "<div><img src='process/" . $row['evidence_path'] . "' alt='Driver Image' class='img-fluid' style='max-width: 30%; height: auto; padding: 5px;'></div>";
                                                        echo "</div>";

                                                            // Displaying the image
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='driver_image" . $row['violation_id'] . "'>Driver Firstname</label>";
                                                        echo "<input type='text' class='form-control' id='officer_name" . $row['violation_id'] . "' name='driver_firstname' value='" . $row['driver_firstname'] . "' >";
                                                        echo "</div>";


                                                               // Displaying the image
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='driver_image" . $row['violation_id'] . "'>Driver Lastname</label>";
                                                        echo "<input type='text' class='form-control' id='officer_name" . $row['violation_id'] . "' name='driver_lastname' value='" . $row['driver_lastname'] . "' >";
                                                        echo "</div>";


                                                                   // Displaying the image
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='driver_image" . $row['violation_id'] . "'>Driver Lastname</label>";
                                                        echo "<input type='text' class='form-control' id='officer_name" . $row['violation_id'] . "' name='driver_licensed' value='" . $row['driver_licensed'] . "' >";
                                                        echo "</div>";


                                                                   // Displaying the image
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='driver_image" . $row['violation_id'] . "'>Vehicle Plate Number</label>";
                                                        echo "<input type='text' class='form-control' id='officer_name" . $row['violation_id'] . "' name='vehicle_plate_number' value='" . $row['vehicle_plate_number'] . "' >";
                                                        echo "</div>";



                                                        // Officer Name
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='officer_name" . $row['violation_id'] . "'>Officer Name</label>";
                                                        echo "<input type='text' class='form-control' id='officer_name" . $row['violation_id'] . "' name='officer_name' value='" . $row['officer_name'] . "' readonly>";
                                                        echo "</div>";
                                                        // Violation Type as Dropdown
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='violation_type" . $row['violation_id'] . "'>Violation Type</label>";
                                                        echo "<select class='form-control' id='violation_type" . $row['violation_id'] . "' name='violation_type'>";

                                                        // Add options for violation types
                                                        $violationTypes = ["Speeding", "Illegal Parking", "Reckless Driving", "Running a Red Light", "No Seatbelt"];
                                                        foreach ($violationTypes as $type) {
                                                            $selected = ($type == $row['violation_type']) ? "selected" : "";
                                                            echo "<option value='$type' $selected>$type</option>";
                                                        }

                                                        echo "</select>";
                                                        echo "</div>";

                                                        // Violation Date
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='violation_date" . $row['violation_id'] . "'>Violation Date</label>";
                                                        echo "<input type='date' class='form-control' id='violation_date" . $row['violation_id'] . "' name='violation_date' value='" . $row['violation_date'] . "' readonly>";
                                                        echo "</div>";

                                                        // Violation Time
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='violation_time" . $row['violation_id'] . "'>Violation Time</label>";
                                                        echo "<input type='time' class='form-control' id='violation_time" . $row['violation_id'] . "' name='violation_time' value='" . $row['violation_time'] . "' readonly>";
                                                        echo "</div>";

                                                        // Additional Notes
                                                        echo "<div class='form-group mb-3'>";
                                                        echo "<label for='additional_notes" . $row['violation_id'] . "'>Additional Notes</label>";
                                                        echo "<textarea class='form-control' id='additional_notes" . $row['violation_id'] . "' name='additional_notes'>" . $row['additional_notes'] . "</textarea>";
                                                        echo "</div>";

                                                        echo "</div>";
                                                        echo "<div class='modal-footer'>";
                                                        echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
                                                        echo "<button type='submit' class='btn btn-primary' name='update_violation'>Save changes</button>";
                                                        echo "</div>";
                                                        echo "</form>";

                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "</div>";

                                                        $count++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><!-- End Table with hoverable rows -->
                                </div>
                            </div><!-- End Tab Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End Main -->

    <?php
        include("admin_footer.php");
    ?>
</body>
</html>
