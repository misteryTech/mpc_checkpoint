<?php

    include("connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $patrol_base_name = $_POST["edit_patrol_base_name"];
        $assigned_date = $_POST["edit_assigned_date"];
        $patrol_id = $_POST["patrol_base_id"];



        $stmt = $connection->prepare("UPDATE patrol_base_tbl SET patrol_basename = ?, assigned_date = ? WHERE patrol_id = ?");

        $stmt->bind_param("ssi",$patrol_base_name,$assigned_date,$patrol_id);


        if($stmt->execute()){
            echo "<script>alert('Successfully Edit Patrol Base');</script>";
           echo "<script>window.location.href='../encode_patrolbase.php'</script>";
        }else{
            echo "<script>alert('Failed To Register);</script>";
        }

        $stmt->close();
        $connection->close();
    }
    ?>