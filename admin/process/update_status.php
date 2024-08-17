<?php
    include("connection.php"); // Include your database connection

    if (isset($_POST['licensed_no'])) {
        $licensed_no = $_POST['licensed_no'];

        // Update status to 'Verified' for the given license number
        $stmt = $connection->prepare("UPDATE profiles SET status = 'Verified' WHERE licensed_no = ?");
        $stmt->bind_param('s', $licensed_no);
        if ($stmt->execute()) {
            echo 'Status updated to Verified.';
        } else {
            echo 'Failed to update status.';
        }

        $stmt->close();
    }

    $connection->close();
?>
