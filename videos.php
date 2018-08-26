
<?php
include 'connect.php';
include 'header.php';
$topic_id=$_GET['id'];
$sql = "SELECT yt_video_id 
		FROM videos 
		WHERE topic_id=$topic_id
		ORDER BY yt_video_id";

$con=mysqli_connect($server, $username, $password,$database);		
$result = mysqli_query($con,$sql);

if(!$result)
		{
			echo 'The Videos could not be displayed, please try again later.';
		}
else
		{
			if(mysqli_num_rows($result) == 0)
			{
				echo 'No videos found.';
			}
			else
			{
				echo '<table border="1">
					  <tr>
						<th>Videos</th>
					  </tr>';
				
				while($row = mysqli_fetch_assoc($result))
				{
					$id=$row['yt_video_id'];
					$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
					parse_str($content, $ytarr);
					$title=$ytarr['title'];
					echo '<tr>';
						echo '<td>';
						echo '<h3><a href="displayvideos.php?id=' . $row['yt_video_id'] . '">' . $title . '</a><br /><h3>';
						echo '</td>';
					echo '</tr>';
				}
				
			}
		}

?>

