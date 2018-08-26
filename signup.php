<?php
include 'connect.php';
?>
<html>
  <head>
		<meta charset="UTF-8">
		<title>Register</title>
		<link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <link rel="stylesheet" href="css/style-login.css">
	</head>

  <body background="images/sign.jpg">

    <div class="login-card">
    <h1>Join-Us</h1><br>
	
<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="">
 	 	<input type="text" name="user_name" placeholder="Username"/><br />
 		<input type="password" name="user_pass" placeholder="Password"><br />
		<input type="password" name="user_pass_check" placeholder="Password (repeat)"><br />
		<input type="email" name="user_email" placeholder="user.mail.id@mail.com"><br />
		<h2><input type="radio" name="isteacher">Teacher<input type="radio" name="isstudent">Student</h2>
 		<input type="submit" class="login login-submit" value="Register" />
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$unm=$_POST['user_name'];
		$upas=$_POST['user_pass'];
		$umail=$_POST['user_email'];
		$udate=date("Y-m-d H:i:s");
		$ulevel=0;
		if(isset($_POST['isteacher']))
		{
			$ulevel=1;
		}
		
		$sql = "INSERT INTO `users`(`user_id`,`user_name`,`user_pass`,`user_email`,`user_date`,`user_level`)
				VALUES(NULL,'$unm','$upas','$umail','$udate',$ulevel)";				
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			
			//echo mysqli_error(mysqli_connect($server, $username, $password)); //debugging purposes, uncomment when needed
		}
		else
		{
			echo '<h2>Registration successfull!!</h2>';
			echo '<h3>Registered at:';
			echo $udate;
			echo '</h3>';
			echo 'You can now <a href="index.php">sign in</a> and start posting!';
		}
	}
}
?>
