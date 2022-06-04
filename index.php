<?php
error_reporting(0);
?>

<?php
$msg = "";

if (isset($_POST['uploadfile'])) {

    $filename = $_FILES["choosefile"]["name"];
    $tempname = $_FILES["choosefile"]["tmp_name"]; 
    $extension = pathinfo($_FILES["choosefile"]["name"], PATHINFO_EXTENSION);

    if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif')
      {
        $msg = "";
        $folder = "uploadFile/".$filename;
        
        $db = mysqli_connect("localhost", "root", "", "image_upload");
        $sql = "INSERT INTO image (filename) VALUES ('$filename')";
        mysqli_query($db, $sql);       
          
          if (move_uploaded_file($tempname, $folder)) {
            $msg = "Image uploaded successfully";
            }else{
            $msg = "Failed to upload image";
            }
      }
    else
    {
      $msg = "File is not image";
    } 
}

$result = mysqli_query($db, "SELECT * FROM image");

?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Image Upload in PHP and MYSQL</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
      <div class="card-header bg">
        <h1>Image Upload in PHP and MYSQL</h1>
        <p><?php echo $msg;?></p>
      </div>
          <div class="card-body">
          <form method="POST" action="" enctype="multipart/form-data">
          <input type="file" name="choosefile" class="form-control" value="" /><br>
          <button type="submit" name="uploadfile" class="btn btn-primary">Upload</button>
          </form>
          </div>
      </div>
    </div>
  </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>