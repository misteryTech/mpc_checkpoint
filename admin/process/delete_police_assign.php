<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $assign_id = $_POST["assign_id"];

            $stmt = $connection->prepare("DELETE FROM patrolbase_assign_tbl WHERE assign_id=?");

            $stmt->bind_param("i",$assign_id);

            $stmt->execute();

            if ($stmt->execute()) {
                // Redirect to the patrol base management page with the assign_id
                echo "<script>
                        alert('Data updated successfully');
                        window.location.href='../assign_police_patrol_page.php?patrol_id=" . urlencode($assign_id) . "';
                      </script>";
            } else {
                echo "<script>alert('Failed to update information');</script>";
            }
            $stmt->close();
    }
    $connection->close();

?>