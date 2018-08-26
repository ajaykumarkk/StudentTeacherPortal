<?php
include 'connect.php';
include 'header.php';
$con=mysqli_connect($server, $username, $password,$database);

$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat =1
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysqli_query($con,$topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							echo '<table border="1">
								  <tr>
									<th>Subject</th>
									<th>Date</th>
								  </tr>';
							
							while($topicrow = mysqli_fetch_assoc($topicsresult))
							{
								echo '<tr>';
								echo '<td class="leftpart">';
								
								echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a>' ;
								echo '</td>';
								echo '<td class="rightpart">';
								echo '<a>'. date('d-m-Y', strtotime($topicrow['topic_date'])).'</a>';
								echo '</td>';
							}
							
						}
					}
	if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1)
	{
		echo '<a class="item2" href="create_topic.php">Create a Topic</a>';
	}
?>
