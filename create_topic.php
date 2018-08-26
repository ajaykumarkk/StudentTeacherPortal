<?php
//create_topic.php
include 'connect.php';
include 'header.php';

echo '<h2>Create a topic</h2>';
if(!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT `cat_id`, `cat_name`, `cat_description` FROM `categories`";				
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					Subject: <input type="text" name="topic_subject" /><br />
					Category:'; 
				
				echo '<select name="topic_cat">';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select><br />';	
					
				echo 'Message: <br /><textarea name="post_content" /></textarea><br /><br />
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$con=mysqli_connect($server, $username, $password,$database);
			$topsub=$_POST['topic_subject'];
			$topcat=$_POST['topic_cat'];
			$uname=$_SESSION['user_id'];
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by)
				   VALUES('$topsub',NOW(),'$topcat','$uname')";
					 
			$result = mysqli_query($con,$sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later!!<br /><br />' . mysql_error();
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				
				$topicid = mysqli_insert_id($con);
				$postcon=$_POST['post_content'];
				$uid=$_SESSION['user_id'];
				$sql = "INSERT INTO `posts`(`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES (NULL,'$postcon',NOW(),$topicid,$uid)";
				$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later!<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">new topic</a>.';
				}
			}
		}
	}
}

?>
