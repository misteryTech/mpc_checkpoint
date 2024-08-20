<?php
    include("admin_header.php");
?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");

        // Fetch patrol ID from the GET request if available
        $patrol_id = isset($_GET['patrol_id']) ? $_GET['patrol_id'] : '';
    ?>

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Patrol Base Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">List of Patrol Bases</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Assign Police to Patrol Base</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" action="process/assign_police_patrolbase.php" method="POST">
                                <div class="col-md-4">
                                    <label for="patrol_base_id" class="form-label">Patrol Base ID</label>
                                    <input type="text" class="form-control" id="patrol_base_id" value="<?php echo htmlspecialchars($patrol_id); ?>" name="patrol_id" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="police_firstname" class="form-label">Police Firstname</label>
                                    <input type="text" class="form-control" id="police_firstname" name="police_firstname" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="police_lastname" class="form-label">Police Lastname</label>
                                    <input type="text" class="form-control" id="police_lastname" name="police_lastname" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="police_rank" class="form-label">Police Rank</label>
                                    <select class="form-control" id="police_rank" name="rank" required>
                                        <option value="" disabled selected>Select Police Rank</option>
                                        <option value="Police Officer I">Police Officer I</option>
                                        <option value="Police Officer II">Police Officer II</option>
                                        <option value="Police Officer III">Police Officer III</option>
                                        <option value="Senior Police Officer I">Senior Police Officer I</option>
                                        <option value="Senior Police Officer II">Senior Police Officer II</option>
                                        <option value="Senior Police Officer III">Senior Police Officer III</option>
                                        <option value="Senior Police Officer IV">Senior Police Officer IV</option>
                                        <option value="Chief Inspector">Chief Inspector</option>
                                        <option value="Superintendent">Superintendent</option>
                                        <option value="Senior Superintendent">Senior Superintendent</option>
                                        <option value="Chief Superintendent">Chief Superintendent</option>
                                        <option value="Police Director">Police Director</option>
                                        <option value="Police Deputy Director General">Police Deputy Director General</option>
                                        <option value="Police Director General">Police Director General</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="police_status" class="form-label">Police Status</label>
                                    <input type="text" class="form-control" id="police_status" name="status" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Police Registered</h5>
                            <table class="table table-hover" id="patrol_base_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Fetch police data based on patrol_id
                                        $stmt = $connection->prepare("SELECT * FROM patrolbase_assign_tbl WHERE patrolbase_id = ?");
                                        $stmt->bind_param("i", $patrol_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>".$count."</td>";
                                            echo "<td>".$row['police_firstname']."</td>";
                                            echo "<td>".$row['police_lastname']."</td>";
                                            echo "<td>".$row['rank']."</td>";
                                            echo "<td>".$row['status']."</td>";
                                            echo "<td>
                                            <div class='d-flex'>
                                                <button data-bs-toggle='modal' data-bs-target='#edit_police" . htmlspecialchars($row['assign_id']) . "' class='btn btn-primary btn-md'>Edit</button>
                                                <span class='mx-1'></span>
                                                <a data-bs-toggle='modal' data-bs-target='#delete_police" . htmlspecialchars($row['assign_id']) . "' class='btn btn-danger btn-md'>Delete</a>
                                            </div>
                                        </td>";
                                            echo "</tr>";

                                            // Modal for editing police details
                                            echo "<div class='modal fade' id='edit_police" . htmlspecialchars($row['assign_id']) . "' tabindex='-1' aria-labelledby='editModalLabel" . htmlspecialchars($row['assign_id']) . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel" . htmlspecialchars($row['assign_id']) . "'>Edit Police Details</h5>";
                                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";

                                            // Form for editing police details
                                            echo "<form action='process/assign_patrol_edit.php' method='POST'>";
                                            echo "<input type='hidden' name='assign_id' value='" . htmlspecialchars($row['assign_id']) . "'>";

                                            // Police Firstname
                                            echo "<div class='form-group mb-3'>";
                                            echo "<label for='police_firstname" . htmlspecialchars($row['assign_id']) . "'>Police Firstname</label>";
                                            echo "<input type='text' class='form-control' id='police_firstname" . htmlspecialchars($row['assign_id']) . "' name='police_firstname' value='" . htmlspecialchars($row['police_firstname']) . "'>";
                                            echo "</div>";

                                            // Police Lastname
                                            echo "<div class='form-group mb-3'>";
                                            echo "<label for='police_lastname" . htmlspecialchars($row['assign_id']) . "'>Police Lastname</label>";
                                            echo "<input type='text' class='form-control' id='police_lastname" . htmlspecialchars($row['assign_id']) . "' name='police_lastname' value='" . htmlspecialchars($row['police_lastname']) . "'>";
                                            echo "</div>";

                                            // Police Rank as Dropdown
                                            echo "<div class='form-group mb-3'>";
                                            echo "<label for='rank" . htmlspecialchars($row['assign_id']) . "'>Police Rank</label>";
                                            echo "<select class='form-control' id='rank" . htmlspecialchars($row['assign_id']) . "' name='rank'>";

                                            // Add options for ranks
                                            $rankTypes = ["Police Officer I", "Police Officer II", "Police Officer III", "Senior Police Officer I", "Senior Police Officer II", "Senior Police Officer III", "Senior Police Officer IV", "Chief Inspector", "Superintendent", "Senior Superintendent", "Chief Superintendent", "Police Director", "Police Deputy Director General", "Police Director General"];
                                            foreach ($rankTypes as $type) {
                                                $selected = ($type == $row['rank']) ? "selected" : "";
                                                echo "<option value='$type' $selected>$type</option>";
                                            }

                                            echo "</select>";
                                            echo "</div>";

                                            // Police Status
                                            echo "<div class='form-group mb-3'>";
                                            echo "<label for='status" . htmlspecialchars($row['assign_id']) . "'>Status</label>";
                                            echo "<input type='text' class='form-control' id='status" . htmlspecialchars($row['assign_id']) . "' name='status' value='" . htmlspecialchars($row['status']) . "'>";
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

                                            // Modal for deleting police record
                                            echo "<div class='modal fade' id='delete_police" . htmlspecialchars($row['assign_id']) . "' tabindex='-1' aria-labelledby='deleteModalLabel" . htmlspecialchars($row['assign_id']) . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . htmlspecialchars($row['assign_id']) . "'>Delete Police Record</h5>";
                                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete the police record of " . htmlspecialchars($row['police_firstname']) . " " . htmlspecialchars($row['police_lastname']) . "?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<form action='process/delete_police_assign.php' method='POST'>";
                                            echo "<input type='hidden' name='assign_id' value='" . htmlspecialchars($row['assign_id']) . "'>";
                                            echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>";
                                            echo "<button type='submit' class='btn btn-danger' name='delete_violation'>Delete</button>";
                                            echo "</form>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            $count++;
                                        }
                                    ?>
                                </tbody>
                            </table><!-- End Table with hoverable rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
        include("admin_footer.php");
    ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#patrol_base_datatable').DataTable();
        });
    </script>

</body>
</html>
