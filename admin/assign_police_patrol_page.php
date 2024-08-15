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
                                            echo "<td class='d-flex'>";
                                            echo "<a class='btn btn-primary me-2' href='edit_police.php?police_id=" . htmlspecialchars($row['assign_id']) . "'>Edit</a>";
                                            echo "<a class='btn btn-danger me-2' href='delete_police.php?police_id=" . htmlspecialchars($row['assign_id']) . "'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";

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
