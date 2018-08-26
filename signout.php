<?php
//signout.php
include 'connect.php';
include 'header.php';

echo '<h2>Sign out</h2>';

//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
	echo 'You are not signed in. Would you like to <a href="signin.php">SignIn</a>?';
}
else
{
	echo 'You are not signed in. Would you like to ';
	echo '<button id="myButton" class="item" >Sign In!</button>

	<script type="text/javascript">
		document.getElementById("myButton").onclick = function () {
			location.href = "signin.php";
		};
	</script>';
	
	echo '?';
	
}

?>