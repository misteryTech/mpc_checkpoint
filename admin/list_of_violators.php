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
                                                        echo "</tr>";
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
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
        include("admin_footer.php");
    ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#solved_violators_table').DataTable();
            $('#unsolved_violators_table').DataTable();
        });
    </script>
</body>
</html>
