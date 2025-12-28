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
<?php
$search_value=$_SESSION["username"];
$directory = "uploads/$search_value"; // Replace with the actual directory path

if (is_dir($directory)) {
    $files = scandir($directory);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
                   

           
     <link rel="stylesheet" type="text/css"
                    href="style.css">

                    <style>
                        

                        input[type=file] {
                      max-width: 100%;
                      color: #444;
                      padding: 5px;
                      background: #fff;
                      border-radius: 10px;
                      border: 1px solid #555;
                    }
                    input[type=file]::file-selector-button {
                      margin-right: 20px;
                      border: none;
                      background: #084cdf;
                      padding: 10px 20px;
                      border-radius: 10px;
                      color: #fff;
                      cursor: pointer;
                      transition: background .2s ease-in-out;
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
                    
                    input[type=file]::file-selector-button:hover {
                      background: #0d45a5;
                    }
                    
                    
                      
                    
                        .upload-container .file-input label:hover {
                          background-color: #45a049;
                        }
                    
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

                            .download-link{
                                margin-right: 20px;
                      border: none;
                      background: #084cdf;
                      padding: 10px 20px;
                      border-radius: 10px;
                      color: #fff;
                      cursor: pointer;
                      transition: background .2s ease-in-out;
                            }
                            #progress-bar-container {
                                                        width: 100%;
                                                        background-color: #f1f1f1;
                                                        margin-bottom: 10px;
                                                        
    }

    #progress-bar {
      width: 0%;
      height: 30px;
      background-color: #4CAF50;
      text-align: center;
      line-height: 30px;
      color: white;
    }
                     
                        </style>
</head>
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
                    <?php echo$_SESSION['username'];?>
                </strong>, Welcome to our site.
            </p>
            <?php
$search_value=$_SESSION["username"];
 $s= mysqli_query($con,"select * from users where username like '%$search_value%'");


  while($r = mysqli_fetch_array($s)){

                echo "Your Status is <b>" . $r["Status"]. "</b><br>";
              }


?>
<div id="progress-bar-container"  style="display: none;">
  <div id="progress-bar">0%</div>
</div>
<div class="file-input">
<form action="upload.php" method="post" enctype="multipart/form-data">
  
  <input type="file" name="fileToUpload" id="fileToUpload" required><br> <br>

  <input type="submit" value="Upload" name="submit" hidden>
</form>
 <br>
<!-- <p><a class="download-link" href="link_down/index.php">Direct Download Via Link</a></p> -->
<br>
</div>
    <table width="100%">
    <th>Type</th>
            <th>Name</th>
            <th>V</th>
            <th>D</th>
          
        </tr>
        <?php
        foreach (array_reverse($files) as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $directory . '/' . $file;
                $shortString = (strlen($file) > 20) ? substr($file, 0, 20) . '...' : $file;
                if (is_dir($filePath)) {
                    echo '<tr>
                    <td><span class="icon">&#128193;</span>Folder</td>
                    <td>' . $file . '</td>
                    <td></td>
                  </tr>';
                } else {
                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileIcon = getFileIcon($fileExtension); // Custom function to get the appropriate file icon based on extension
                    echo '<tr>
                    <td><span class="icon">' . $fileIcon . '</span>File</td>
                    <td title="' . $file . '">' . $shortString . '</td>
                <td><a class="download-btn" href="watch.php?file=' . urlencode($file) . '" target="_blank">👀</a></td>

                    <td><a class="download-btn" href="' . $filePath . '" download="' . $file . '">⏬</a></td>
                   
                    
                  </tr>';
                }
            }
        }
        ?>
    </table>
<br>
    <center>
                <a href="index.php?logout='1'" style="color: red;">
                    Logout
                </a>
            </center>
      </div>
      
 



     
<!-- JavaScript to update the progress bar -->
<script>
  // Get the file input element
  const fileInput = document.querySelector('#fileToUpload');

  // Listen for the 'change' event on the file input
  fileInput.addEventListener('change', (event) => {
    const progressBarContainer = document.querySelector('#progress-bar-container');
  progressBarContainer.style.display = 'block';

    // Get the selected file
    const file = event.target.files[0];

    // Create a new FormData object
    const formData = new FormData();

    // Append the selected file to the FormData object
    formData.append('fileToUpload', file);

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure the XMLHttpRequest
    xhr.open('POST', 'upload.php');

    // Listen for the 'load' event on the XMLHttpRequest
    xhr.onload = function() {
      if (xhr.status === 200) {
        // File upload successful, redirect to index.php
        window.location.href = 'index.php';
      } else {
        // File upload failed, display an error message
        console.error('File upload failed');
      }
    };

    // Listen for the 'progress' event on the XMLHttpRequest
    xhr.upload.onprogress = function(event) {
      // Calculate the progress percentage
      const progress = Math.round((event.loaded / event.total) * 100);

      // Update the progress bar
      const progressBar = document.querySelector('#progress-bar');
      progressBar.style.width = progress + '%';
      progressBar.textContent = progress + '%';
    };

    // Send the FormData object via the XMLHttpRequest
    xhr.send(formData);
  });
</script>

</body>
</html>
<?php
} else {
    echo "Invalid directory path.";
}

// Custom function to get the appropriate file icon based on extension
function getFileIcon($fileExtension) {
    // You can define your own set of file icons based on extension
    $fileIcons = [
        'pdf' => '&#128462;',
        'doc' => '&#128196;',
        'docx' => '&#128196;',
        'xls' => '&#128197;',
        'xlsx' => '&#128197;',
        'jpg' => '&#128247;',
        'png' => '&#128247;',
        'txt' => '&#128196;'
        // Add more file extensions and corresponding icons as needed
    ];
    
    return isset($fileIcons[$fileExtension]) ? $fileIcons[$fileExtension] : '&#128190;'; // Default icon if extension not found
}
?>
