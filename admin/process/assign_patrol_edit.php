<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $police_firstname = $_POST["police_firstname"];
    $police_lastname = $_POST["police_lastname"];
    $rank = $_POST["rank"];
    $status = $_POST["status"];
    $assign_id = $_POST["assign_id"];

    // Prepare the update statement
    $stmt = $connection->prepare("UPDATE patrolbase_assign_tbl SET police_firstname=?, police_lastname=?, rank=?, status=? WHERE assign_id=?");
    $stmt->bind_param("ssssi", $police_firstname, $police_lastname, $rank, $status, $assign_id);

    if ($stmt->execute()) {
        // Redirect to the patrol base management page with the assign_id
        echo "<script>
                alert('Data updated successfully');
                window.location.href='../assign_police_patrol_page.php?patrol_id=" . urlencode($assign_id) . "';
              </script>";
    } else {
        echo "<script>alert('Failed to update information');</script>";
    }

    // Close the statement
    $stmt->close();
}
?>
