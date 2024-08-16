<?php

include("connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password for security
    $role = $_POST['role'];
    $status = $_POST['status'];

    $stmt = $connection->prepare("INSERT INTO user_table (firstname, lastname, email, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $username, $password, $role, $status);

    if($stmt->execute()){
            echo   "<script>alert('User Successfully Registered');</script>";
            echo  "<script>window.location.href='../register_user.php'</script>";
    }else{
        echo "<script>alert('Failed To Register);</script>";
    }

    $stmt->close();
    $connection->close();
}
?>
