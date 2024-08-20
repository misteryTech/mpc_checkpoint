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
                            <form class="row g-3" action="process/patrol_base_registration.php" method="POST">
                                <div class="col-md-4">
                                    <label for="patrol_base_name" class="form-label">Patrol Base Name</label>
                                    <input type="text" class="form-control" id="patrol_base_name" name="patrol_base_name" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="assigned_date" class="form-label">Assigned Date</label>
                                    <input type="date" class="form-control" id="assigned_date" name="assigned_date" required>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Patrol Bases</h5>
                            <table class="table table-hover" id="patrol_base_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Patrol Base Name</th>
                                        <th scope="col">Assigned Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $connection->prepare("SELECT * FROM patrol_base_tbl");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>".$count."</td>";
                                            echo "<td>".$row['patrol_basename']."</td>";
                                            echo "<td>".$row['assigned_date']."</td>";
                                            echo "<td class='d-flex'>";
                                            echo "<a class='btn btn-secondary me-2' href='assign_police_patrol_page.php?patrol_id=" . htmlspecialchars($row['patrol_id']) . "'>Assign</a>";
                                            echo "<button class='btn btn-primary me-2' data-toggle='modal' data-target='#editModal" . $row['patrol_id'] . "'>Edit</button>";

                                            echo "</td>";
                                            echo "</tr>";

                                            $count++;

                                            // Edit Modal
                                            echo "<div class='modal fade'  id='editModal" . $row['patrol_id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['patrol_id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel" . $row['patrol_id'] . "'>Edit Patrol Base Assignment</h5>";
                                            echo " <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<form action='process/patrol_base_edit.php' method='POST'>";
                                            echo "<input type='hidden' name='patrol_base_id' value='" . $row['patrol_id'] . "'>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editPatrolBaseName" . $row['patrol_id'] . "'>Patrol Base Name</label>";
                                            echo "<input type='text' class='form-control' id='editPatrolBaseName" . $row['patrol_id'] . "' name='edit_patrol_base_name' value='" . $row['patrol_basename'] . "' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editAssignedDate" . $row['patrol_id'] . "'>Assigned Date</label>";
                                            echo "<input type='date' class='form-control' id='editAssignedDate" . $row['patrol_id'] . "' name='edit_assigned_date' value='" . $row['assigned_date'] . "' required>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                            echo "</form>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            // Delete Modal
                                            echo "<div class='modal fade' id='deleteModal" . $row['patrol_id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel" . $row['patrol_id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog' role='document'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . $row['patrol_id'] . "'>Delete Patrol Base Assignment</h5>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete this assignment?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<form action='process_code/patrol_base_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='patrol_base_id' value='" . $row['patrol_id'] . "'>";
                                            echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
                                            echo "</form>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
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
