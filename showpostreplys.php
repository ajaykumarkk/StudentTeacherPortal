<?php
include 'connect.php';
include 'header.php';
$post_id=$_GET['id'];
$sql = "SELECT
			posts.post_id,
			posts.post_content
		FROM
			posts
		WHERE
			posts.post_id=$post_id ";

$con=mysqli_connect($server, $username, $password,$database);		
$result = mysqli_query($con,$sql);

if(!$result)
{
	echo 'The replys to the post could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'There are no such posts.';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['post_content'] . '</th>
					</tr>';
					
			//fetch the posts from the database
			$replys_sql = "SELECT
						reply.reply_id,
						reply.reply_content,
						reply.reply_by,
						reply.reply_post,
						users.user_id,
						users.user_name
					FROM
						reply
					LEFT JOIN
						users
					ON
						reply.reply_by = users.user_id
					WHERE
						reply.reply_post = $post_id";
						
			$replys_result = mysqli_query($con,$replys_sql);
			
			if(!$replys_result)
			{
				echo '<tr><td>The replys could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($replys_row = mysqli_fetch_assoc($replys_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post">' . $replys_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime("2015-10-08 19:34:29")) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($replys_row['reply_content'])) . '</a></td>
						  </tr>';
				}
			}
			
			if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="replytopost.php?id=' . $post_id . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

?>
			