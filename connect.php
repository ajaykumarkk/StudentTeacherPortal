<?php 
session_start();
//connect.php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'test';

if(!mysqli_connect($server, $username, $password))
{
 	exit('Error: could not establish database connection');
}
if(!mysqli_select_db(mysqli_connect($server, $username, $password),$database))
{
 	exit('Error: could not select the database');
}
?>