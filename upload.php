<?php
include 'header.php';
include 'connect.php';
$uid=$_SESSION['user_id'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$uploadfilename="";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$tag=$_POST["tags"];


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$uploadfilename= $_FILES["fileToUpload"]["name"];
        echo "<h2>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h2>";
		$sql="INSERT INTO fileupload VALUES ('$uploadfilename','$tag',$uid)";
		$con=mysqli_connect($server, $username, $password,$database);
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
		
		if($result!=null)
		{
			echo "<h3> Your question paper has been uploaded with tags.</h3>";
		}
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>