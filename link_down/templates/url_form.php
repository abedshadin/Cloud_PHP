
<?php include('../db.php') ?>
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
    header('location: ../login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Cloud</title>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
   
                   

           
   <link rel="stylesheet" type="text/css"
				  href="../style.css">
<style type="text/css">

html body {
	margin-top: 50px !important;
}

#top_form {
	position: fixed;
	top:0;
	left:0;
	width: 100%;
	
	margin:0;
	
	z-index: 2100000000;
	-moz-user-select: none; 
	-khtml-user-select: none; 
	-webkit-user-select: none; 
	-o-user-select: none; 
	
	border-bottom:1px solid #151515;
	
    background:#FFC8C8;
	
	height:45px;
	line-height:45px;
}

#top_form input[name=url] {
	width: 550px;
	height: 20px;
	padding: 5px;
	font: 13px "Helvetica Neue",Helvetica,Arial,sans-serif;
	border: 0px none;
	background: none repeat scroll 0% 0% #FFF;
}
.links{
								height: 32px;
    width: 90%;
    padding: 5px 5px;
    font-size: 12px;
    border-radius: 10px;
    border: 1px solid gray;
							}
							input[type=submit] {
                      margin-right: 20px;
                      border: none;
                      background: #084cdf;
                      padding: 10px 20px;
                      border-radius: 10px;
                      color: #fff;
                      cursor: pointer;
                      transition: background .2s ease-in-out;
                    }
</style>

<script>
var url_text_selected = false;

function smart_select(ele){

	ele.onblur = function(){
		url_text_selected = false;
	};
	
	ele.onclick = function(){
		if(url_text_selected == false){
			this.focus();
			this.select();
			url_text_selected = true;
		}
	};
}
					
                    
</script>

<div class="header">
        <h2>Cloud</h2>
    </div>
    <div class="content">

	<center>
    <a href="../index.php" >
                    🔙 Back to Home
                </a> <br>
                 <br>
	<div style="">
	
		<form method="post" action="index.php" target="_top" style="margin:0; padding:0;">
			
			<input type="text" name="url" value="<?php echo $url; ?>" autocomplete="off" class="links">
			<input type="hidden" name="form" value="1"><br>
			<br>
			<input type="submit" value="Download">
		</form>
		
	</div>
</center>
<br>
	<br>
    <center>
                <a href="index.php?logout='1'" style="color: red; font-size:15px">
                    Logout
                </a>
            </center>
</div>

<script type="text/javascript">
	smart_select(document.getElementsByName("url")[0]);
</script>
