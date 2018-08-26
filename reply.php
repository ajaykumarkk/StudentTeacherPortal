<?php
//create_cat.php
include 'connect.php';
include 'header.php';
$id=$_GET['id'];
$uid=$_SESSION['user_id'];
$content=$_POST['reply-content'];
$con=mysqli_connect($server, $username, $password,$database);	

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		$sql="INSERT INTO `posts`(`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES (NULL,'$content',NOW(),$id,$uid)";
		$result = mysqli_query($con,$sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
		}
	}
}

?>