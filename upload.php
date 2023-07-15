<?php include('db.php') ?>
<?php

// Starting the session, to use and
// store data in session variable
session_start();

// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Error</title>
</head>
<body>
<div class="header">
        <h2>Cloud</h2>
    </div>
    <div class="content">




























    <?php
$search_value = $_SESSION["username"];
$target_dir = "uploads/$search_value/";

$filename = basename($_FILES["fileToUpload"]["name"]);
$randomString = uniqid();

// Get the extension of the uploaded file
$extension = pathinfo($filename, PATHINFO_EXTENSION);

// Remove the extension from the filename
$filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

// Concatenate the random value after the file name
$target_file = $target_dir . $filenameWithoutExtension . "_" . $randomString . "." . $extension;

$uploadOk = 1;
$imageFileType = strtolower($extension);

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo header("Location: index.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<center><br><a href="index.php">Back To Home Page</a></center>

</body>
</html>