<?php
include 'connect.php';
?>
<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/questionpaper.css" type="text/css">
 	<title>Question Papers</title>
</head>
<body background="/forum/images/sign.jpg">
<h1>Question Papers</h1>
<a class="button" href="qpupload.php">Upload a file</a>
<form action="filesearch.php" method="post" enctype="multipart/form-data">
  <h3><br/>Enter the filename or tags to be searched for:</h3>
    <br>Enter Tags:<input type="text" name="tags" >
    <br><br><input type="submit" value="Search the file" name="submit">
</form>
</body>