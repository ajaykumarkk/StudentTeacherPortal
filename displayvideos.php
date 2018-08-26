<html>
<head>
 	<title>Videos</title>
	<link rel="stylesheet" href="css/video.css" type="text/css">
</html>
<?php
$vid_id=$_GET['id'];
$url='https://www.youtube.com/embed/'.$vid_id;
$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$vid_id);
parse_str($content, $ytarr);
$title=$ytarr['title'];
ECHO '<div class="sp-container">
				<div class="sp-content">';

echo '<h1>'.$title.'</h1>';

ECHO '</div>
			</div>';

echo '<div class="videoWrapper">
	<iframe src="'.$url.'" frameborder="1" allowfullscreen></iframe>
	</iframe>
	</div>';
?>