<link rel="stylesheet" href="css/questionpaper.css" type="text/css">
<?php
include 'connect.php';
include 'header.php';
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==True)
		{
			echo '<a class="item1" href="signout.php">Sign Out</a>';
		}
		else
		{
			echo '<a class="item1" href="index.php">Sign in</a><a class="item2" href="signup.php">create an account</a>';
			echo '<a class="text">or</a>';
		}
?>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  <h2>Choose the question paper:</h2>
    <input type="file" name="fileToUpload" id="fileToUpload">
	<br><br>(separated by space)<h3>Enter Tags:</h3><input type="text" name="tags" >
    <br><br><input type="submit" value="Upload the file" name="submit">
</form>
</body>
</html>