<?php

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patrol_id = $_POST["patrol_id"];
    $police_firstname = $_POST["police_firstname"];
    $police_lastname = $_POST["police_lastname"];
    $rank = $_POST["rank"];
    $status = $_POST["status"];

    $stmt = $connection->prepare("INSERT INTO patrolbase_assign_tbl(patrolbase_id, police_firstname, police_lastname, rank, status)
    VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("issss", $patrol_id, $police_firstname, $police_lastname, $rank, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Assignment recorded successfully');</script>";
        echo "<script>window.location.href='../assign_police_patrol_page.php?patrol_id=" . $patrol_id . "';</script>";
    } else {
        echo "<script>alert('Failed to record assignment');</script>";
        echo "<script>window.location.href='../assign_police_patrol_page.php?patrol_id=" . $patrol_id . "';</script>";
    }

    $stmt->close();
    $connection->close();
}
?>
