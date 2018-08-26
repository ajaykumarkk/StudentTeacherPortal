<link rel="stylesheet" href="css/questionpaper.css" type="text/css">
<?php
include 'header.php';
include 'connect.php';
$tags=$_POST["tags"];
$sql="SELECT file_name FROM fileupload WHERE tags LIKE '%$tags%'";
$con=mysqli_connect($server, $username, $password,$database);
$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
echo '<h2>Papers with requested tags are:</h2><h4>';
while($row = mysqli_fetch_assoc($result))
{
	$file=$row['file_name'];
	echo '<a href="downloadfile.php?filename=' . $file . '">';
	echo $file;
	echo '</a><br/>';
}

?>