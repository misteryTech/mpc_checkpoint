<?php
session_start();

include('connection.php');



if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST['username'];
        $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT assign_id,police_firstname,police_lastname,rank FROM patrolbase_assign_tbl WHERE username=? AND password=?");

    $stmt->bind_param("ss",$username,$password);

    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1){
            $stmt->bind_result($assign_id,$firstname,$police_lastname,$rank);
            $stmt->fetch();

                $_SESSION['loggedin'] = true;
                $_SESSION['assign_id'] = $assign_id;
                $_SESSION['police_firstname'] = $police_firstname;
                $_SESSION['police_lastname'] = $police_lastname;
                $_SESSION['username'] = $username;
                $_SESSION['rank'] = $rank;


                header("location: ../police/police_dashboard.php");
                exit();

    }else{
            echo    "<script>alert('Invalid Username or Password')</script>";
            echo    "<script>window.location.href='../police_login.php'</script>";
    }
        $stmt->close();
        $connection->close();
}

?>