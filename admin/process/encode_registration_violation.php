<?php

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patrol_base = $_POST["patrol_base"];
    $violation_type = $_POST["violation_type"];
    $vehicle_plate_number = $_POST["vehicle_plate_number"];
    $driver_firstname = $_POST["driver_firstname"];
    $driver_lastname = $_POST["driver_lastname"];
    $driver_licensed = $_POST["driver_licensed"];
    $violation_location = $_POST["violation_location"];
    $violation_date = $_POST["date"];
    $violation_time = $_POST["time"];
    $additional_notes = $_POST["additional_notes"];
    $status = "Unsolved";

    // Handle evidence file upload
    $evidence_path = null;
    if (!empty($_FILES["evidence"]["name"])) {
        $target_dir = "uploads/evidence/";
        $target_file = $target_dir . basename($_FILES["evidence"]["name"]);
        if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
            $evidence_path = $target_file;
        }
    }

    // Handle driver image upload
    $driver_image_path = null;
    if (!empty($_FILES["driver_image"]["name"])) {
        $target_dir = "uploads/driver_images/";
        $target_file = $target_dir . basename($_FILES["driver_image"]["name"]);
        if (move_uploaded_file($_FILES["driver_image"]["tmp_name"], $target_file)) {
            $driver_image_path = $target_file;
        }
    }

    // Corrected SQL statement and bind_param
    $stmt = $connection->prepare("INSERT INTO traffic_violations (
            officer_name, violation_type, vehicle_plate_number, driver_image_path,
            violation_location, violation_date, violation_time, evidence_path,
            additional_notes, status, driver_firstname, driver_lastname, driver_licensed
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssss", $patrol_base, $violation_type, $vehicle_plate_number,
                      $driver_image_path, $violation_location, $violation_date,
                      $violation_time, $evidence_path, $additional_notes,
                      $status, $driver_firstname, $driver_lastname, $driver_licensed);

                      if ($stmt->execute()) {
                        echo "<script>alert('Violation recorded successfully');</script>";
                        echo "<script>window.location.href='../encode_violation.php'</script>";
                    } else {
                        echo "<script>alert('Failed to record violation');</script>";
                    }
}
?>
