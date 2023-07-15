<?php include('db.php') ?>
<?php

// Starting the session, to use and
// store data in session variable
session_start();

// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['admin_name'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Admin Panel</title>
</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../style.css">
<body>

<div class="header">
        <h2>Cloud</h2>
    </div>
    <div class="content">
    <?php


$s= mysqli_query($con,"select * from modal ORDER BY id DESC limit 1");


 while($r = mysqli_fetch_array($s)){

               echo "<marquee style='color: #3c763d; font-weight:700;'>" . $r["News"]. "</marquee>";
             }


?>
    
    <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <p>
                Hello
                <strong>
                    <?php echo$_SESSION['admin_name'];?>
                </strong>, Welcome to our site.
            </p>
            <?php
$search_value=$_SESSION["admin_name"];






?>





<center>
<a class="nav-link" href="index.php">Dashboard <span class="sr-only"></span></a> &nbsp;&nbsp;&nbsp;
<a class="nav-link" href="users.php">Users</a>&nbsp;&nbsp;&nbsp;
<a class="nav-link" href="notice.php">Notice</a>&nbsp;&nbsp;&nbsp;
</center>


<form action="" method="POST">
<p><span style="font-size:24px;"> Notice</span></p>

<textarea name="News" required="" style="height:150px;" type="text"></textarea><br />
<br />
<input style="width:150px; height:40px" type="submit" name="mod" value="Submit" /></p>
</form>


<?php
include('db.php');
if (isset($_POST['mod']))
{
    
     $News = $_POST['News'];
    
    
         $s= mysqli_query($con,"insert into modal (News) value('$News')"); 
         echo "Success.....";
    header("location:index.php");
}





    ?>
    
    <center>
      
      <br>
                <a href="index.php?logout='1'" style="color: red;">
                    Logout
                </a>
            </center>
    </body>
    </html>