<link rel="stylesheet" href="css/questionpaper.css" type="text/css">
<?php
include 'header.php';
include 'connect.php';
$file=$_GET['filename'];

if (file_exists('uploads\\'.$file))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
else
{
	echo "File not found";
}