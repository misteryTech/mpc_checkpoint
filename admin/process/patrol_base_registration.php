<?php

    include("connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $patrol_base_name = $_POST["patrol_base_name"];
        $assigned_date = $_POST["assigned_date"];




        $stmt = $connection->prepare("INSERT INTO patrol_base_tbl(patrol_basename,assigned_date)
                VALUES (?,?)");

        $stmt->bind_param("ss",$patrol_base_name,$assigned_date);


        if($stmt->execute()){
            echo "<script>alert('Successfully Registered Patrol Base');</script>";
           echo "<script>window.location.href='../encode_patrolbase.php'</script>";
        }else{
            echo "<script>alert('Failed To Register);</script>";
        }

        $stmt->close();
        $connection->close();
    }
    ?>