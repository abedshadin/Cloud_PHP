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

<meta name="generator" content="php-proxy.com">
<meta name="version" content="<?=$version;?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
   
                   

           
   <link rel="stylesheet" type="text/css"
				  href="../style.css">
<style type="text/css">
html body {
	font-family: Arial,Helvetica,sans-serif;
	font-size: 12px;
}

#container {
	width:500px;
	margin:0 auto;
	margin-top:150px;
}

#error {
	color:red;
	font-weight:bold;
}

#frm {
	padding:10px 15px;
	background-color:#FFC8C8;
	
	border:1px solid #818181;
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

#footer {
	text-align:center;
	font-size:10px;
	margin-top:35px;
	clear:both;
}

       

/* input[type=name] {
                      max-width: 100%;
                      color: #444;
                      padding: 5px;
                      background: #fff;
                      border-radius: 10px;
                      border: 1px solid #555;
                    } */
                    /* input[type=name]::file-selector-button {
                      margin-right: 20px;
                      border: none;
                      background: #084cdf;
                      padding: 10px 20px;
                      border-radius: 10px;
                      color: #fff;
                      cursor: pointer;
                      transition: background .2s ease-in-out;
                    } */
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
                    
                    /* input[type=name]::file-selector-button:hover {
                      background: #0d45a5;
                    } */
                    
                    
                      
                    
                       
                        .file-input{
                          margin-top:10px;
                          margin-bottom:10px;
                          text-align: center;
                        }
                    
                    
                    
                        ul {
                                list-style-type: none;
                                margin: 0;
                                padding: 0;
                            }
                            
                            li {
                                display: flex;
                                align-items: center;
                                margin-bottom: 10px;
                            }
                            
                            .folder {
                                color: blue;
                                font-weight: bold;
                            }
                            
                            .file {
                                color: black;
                            }
                            
                            .icon {
                                margin-right: 10px;
                            }
                            
                            .download-btn {
                                background-color: #4CAF50;
                                border: none;
                                color: white;
                                padding: 5px 10px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                cursor: pointer;
                            }
                    
                            ul {
                                list-style-type: none;
                                margin: 0;
                                padding: 0;
                            }
                            
                            li {
                                display: flex;
                                align-items: center;
                                margin-bottom: 10px;
                            }
                            
                            .folder {
                                color: blue;
                                font-weight: bold;
                            }
                            
                            .file {
                                color: black;
                            }
                            
                            .icon {
                                margin-right: 10px;
                            }
                            
                            .download-btn {
                                background-color: #4CAF50;
                                border: none;
                                color: white;
                                padding: 5px 10px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                cursor: pointer;
                            }

							.links{
								height: 32px;
    width: 90%;
    padding: 5px 5px;
    font-size: 12px;
    border-radius: 10px;
    border: 1px solid gray;
							}
                    
</style>

</head>

<body>

<div class="header">
        <h2>Cloud</h2>
    </div>
    <div class="content">
<div id="">

	<div style="text-align:center;">
	
	</div>
	
	<?php if(isset($error_msg)){ ?>
	
	<div id="error">
		<p><?php echo strip_tags($error_msg); ?></p>
	</div>
	
	<?php } ?>
	
	<center>
    <a href="../index.php" >
                    🔙 Back to Home
                </a> <br>
                 <br>
	<!-- I wouldn't touch this part -->
	
		<form action="index.php" method="post" style="margin-bottom:0;">
			<input name="url" type="text" class="links"  autocomplete="off" required placeholder="http://" />
			<br>
			<br>
			<input type="submit" value="Download" />
		</form>
		
		<script type="text/javascript">
			document.getElementsByName("url")[0].focus();
		</script>
		
	<!-- [END] -->
	
	</center>
	<br>
	<br>
    <center>
                <a href="../index.php?logout='1'" style="color: red; font-size:15px">
                    Logout
                </a>
            </center>
</div>
</div>




</body>
</html>