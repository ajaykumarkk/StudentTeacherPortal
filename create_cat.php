<?php
//create_cat.php
include 'connect.php';
include 'header.php';

echo '<h2>Create a category</h2>';
if(!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] == false )
{
	//the user is not an admin
	echo "Please <a href='/forum/signin.php'>sign in</a> to create a category!";
}
else if(isset($_SESSION['user_level']) && $_SESSION['user_level'] != 1 )
{
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" /><br />
			Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$catname=$_POST['cat_name'];
		$catdesc=$_POST['cat_description'];
		$sql = "INSERT INTO categories(cat_id, cat_name, cat_description) VALUES (NULL,'$catname','$catdesc')";				
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error while creating category';
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}

?>
