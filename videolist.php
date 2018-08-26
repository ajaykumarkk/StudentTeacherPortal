<?php
include 'connect.php';
include 'header.php';
$sql = "SELECT topics.topic_id,topics.topic_subject,users.user_name 
		FROM topics,users 
		WHERE topics.topic_by=users.user_id;";

$con=mysqli_connect($server, $username, $password,$database);		
$result = mysqli_query($con,$sql);

if(!$result)
		{
			echo 'The Subjects could not be displayed, please try again later.';
		}
else
		{
			if(mysqli_num_rows($result) == 0)
			{
				echo 'There are no subjects defined yet.';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created by</th>
					  </tr>';	
					
				while($row = mysqli_fetch_assoc($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="videos.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo $row['user_name'];
						echo '</td>';
					echo '</tr>';
				}
			}
		}

?>
