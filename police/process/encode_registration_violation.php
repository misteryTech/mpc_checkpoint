<?php

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patrol_base = $_POST["patrol_base"];
    $violation_type = $_POST["violation_type"];
    $vehicle_plate_number = $_POST["vehicle_plate_number"];
    $driver_name = $_POST["driver_name"];
    $violation_location = $_POST["violation_location"];
    $violation_date = $_POST["date"];
    $violation_time = $_POST["time"];
    $additional_notes = $_POST["additional_notes"];
    $status = "Unsolved";

    // Handle file upload
    $evidence_path = null;
    if (!empty($_FILES["evidence"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["evidence"]["name"]);
        if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
            $evidence_path = $target_file;
        }
    }

    $stmt = $connection->prepare("INSERT INTO traffic_violations (
            officer_name, violation_type, vehicle_plate_number,
            driver_name, violation_location, violation_date,
            violation_time, evidence_path, additional_notes, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssss", $patrol_base, $violation_type, $vehicle_plate_number, $driver_name,
                      $violation_location, $violation_date, $violation_time, $evidence_path, $additional_notes, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Violation recorded successfully');</script>";
        echo "<script>window.location.href='../encode_violation.php'</script>";
    } else {
        echo "<script>alert('Failed to record violation');</script>";
    }

    $stmt->close();
    $connection->close();
}
?>
