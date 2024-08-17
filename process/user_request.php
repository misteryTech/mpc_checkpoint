<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $license_no = $_POST['license_no'];
    $status = 'Request';

    // Handling image upload
    $target_dir = "uploads/";
    $driver_image = $target_dir . basename($_FILES["driver_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($driver_image, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["driver_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["driver_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["driver_image"]["tmp_name"], $driver_image)) {
            // Prepare SQL and bind parameters
            $stmt = $connection->prepare("INSERT INTO profiles (first_name, last_name, email, phone, licensed_no, driver_image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $phone, $license_no, $driver_image, $status);


            if($stmt->execute()){
                echo "<script>alert('Successfully Request for Profiling');</script>";
               echo "<script>window.location.href='../index.php'</script>";
            }else{
                echo "<script>alert('Failed To Register);</script>";
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $connection->close();
}
?>
