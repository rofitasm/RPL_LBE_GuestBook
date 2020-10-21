<?php
// include database connection file
include_once("condb.php");

if ($_POST['act'] == "add"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $msg = $_POST['msg'];

    // Insert user data into table
    $result = mysqli_query($mysqli, "INSERT INTO guestbook(name,email,address,city,msg) VALUES('$name','$email','$address','$city','$msg')");
    mysqli_close($mysqli);

    header("Location: index.php");
    die();
}
else if ($_POST['act'] == "edit"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $msg = $_POST['msg'];
    $id = $_POST['id'];

    // Insert user data into table
    $result = mysqli_query($mysqli, "UPDATE guestbook SET `name`='$name', `email`='$email', `address`='$address', `city`='$city', `msg`='$msg' WHERE `id`='$id'");
    mysqli_close($mysqli);

    header("Location: index.php");
    die();
}
else if($_GET['act'] == "delete"){
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "DELETE FROM guestbook WHERE `id` = '$id'");
    mysqli_close($mysqli);

    header("Location: index.php");
    die();
}