<?php
include("connection.php"); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $licensed_no = $_POST['licensed_no'];
    $release_date = $_POST['release_date'];
    $status = $_POST['status'];

    // Update the database
    $stmt = $connection->prepare("UPDATE profiles SET status = ?, released_date = ? WHERE licensed_no = ?");
    $stmt->bind_param('sss', $status, $release_date, $licensed_no);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $connection->close();
}
?>
