<html>
<head>
  <title>IT SOURCECODE | Upload and Download File</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<style>
.form{
width: 100%;
display: inline-block;
position: inherit;
padding: 6px;
}

.label {
padding: 10px;
width: 10%;
}
.input{
position: inherit;
padding: 3px;
margin-left: 2.3%;
}

.btn{
margin-left: 6.5%;
background-color: blue;
color: white;
}
</style>
<?php
include('db.php');
if (mysqli_connect_errno()) {
echo "Unable to connect to MySQL! ". mysqli_connect_error();
}
if (isset($_POST['save'])) {
$target_dir = "Uploaded_Files/";
$target_file = $target_dir . date("dmYhis") . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg" || $imageFileType != "gif" ) {
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
$files = date("dmYhis") . basename($_FILES["file"]["name"]);
}else{
echo "Error Uploading File";
exit;
}
}else{
echo "File Not Supported";
exit;
}

$filename = $_POST['filename'];
$location = "Uploaded_Files/" . $files;
$sqli = "Update `users` SET Location = '$location', FileName = '$filename'where id=1";
$result = mysqli_query($con,$sqli);
if ($result) {
echo "File has been uploaded";
};
}
?>
<center>
<h1>Upload and Download</h1>
<form class="form" method="post" action="" enctype="multipart/form-data">
<label>Filename:</label>
<input type="text" name="filename" > <br/>
<div style="margin-left: 9%">
<label>File:</label>
<input type="file" name="file"> <br/>
</div>
<button type="submit" name="save" class="btn"><i class="fa fa-upload fw-fa"></i> Upload</button>
</form>
</center>
<br>


<div class="container">
<table id="demo" class="table table-bordered">
<thead>
<tr>
<td>FileName</td>
<td>Download</td>
</tr>
</thead>
<tbody>
<?php
$sqli = "SELECT * FROM `users`";
$res = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($res)) {
echo '<tr>';
echo '<td>'.$row['FileName'].'</td>';
echo '<td><a class="btn" href="'.$row['Location'].'">Download</a></td>';
echo '</tr>';
}
mysqli_close($con);
?>
</tbody>
</table>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
</script>
</body>
</html>
