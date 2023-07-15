
<?php $i = $_GET['i']; ?>













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
$i = $_GET['i'];
$id = $_POST['id'];
$filename = $_POST['filename'];
$source = $_POST['source'];
$location = "admin/Uploaded_Files/" . $files;
$sqli = "Update `users` SET Location = '$location', source = '$source', FileName = '$filename'where id='$id'";
$result = mysqli_query($con,$sqli);
if ($result) {
header("location:index.php");
};
}

?>
    <center>
    <h1>Upload Config</h1>
    <form class="form" method="post" action="" enctype="multipart/form-data">
    <!-- <label>Filename:</label> -->
    <input type="hidden" name="filename" > <br/>
    <label>Code/Source :</label>
      <input type="text" name="source" > <br/><br/>
    <input type="hidden" name="id" value="<?php echo $i; ?>"/>
    <div style="margin-left: 9%">
    <label>File:</label>
    <input type="file" name="file"> <br/>
    </div><br/><br/>
    <button type="submit" name="save" class="btn"><i class="fa fa-upload fw-fa"></i> Upload</button>
    </form>
    </center>
    <br>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
    </script>
    </body>
    </html>
