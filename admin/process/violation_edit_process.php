<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $violation_id = $_POST['violation_id'];
    $officer_name = $_POST['officer_name'];
    $violation_type = $_POST['violation_type'];
    $violation_date = $_POST['violation_date'];
    $violation_time = $_POST['violation_time'];
    $additional_notes = $_POST['additional_notes'];
    $driver_firstname = $_POST['driver_firstname']; // Corrected 'fistrname' to 'firstname'
    $driver_lastname = $_POST['driver_lastname'];
    $driver_licensed  = $_POST['driver_licensed']; // Corrected 'licensed'
    $vehicle_platenumber = $_POST['vehicle_plate_number']; // Corrected 'vehiclie' to 'vehicle'

    // Updated SQL query to include the new fields
    $stmt = $connection->prepare("UPDATE traffic_violations SET officer_name = ?, violation_type = ?, violation_date = ?, violation_time = ?, additional_notes = ?, driver_firstname = ?, driver_lastname = ?, driver_licensed = ?, vehicle_plate_number = ? WHERE violation_id = ?");
    $stmt->bind_param("sssssssssi", $officer_name, $violation_type, $violation_date, $violation_time, $additional_notes, $driver_firstname, $driver_lastname, $driver_licensed, $vehicle_platenumber, $violation_id);

    if ($stmt->execute()) {
        echo "<script>alert('Violation details successfully updated');</script>";
        echo "<script>window.location.href='../list_of_violators.php'</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
