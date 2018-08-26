<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>Forums</title>
	<link rel="stylesheet" href="css/style-forum.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="menu-script.js"></script>
</head>
<body background="images/sign.jpg">
<h1>Forums</h1>
<div id='cssmenu'>
<ul>
   <li><a href='forum-main.php'>Home</a></li>
   <li class='active has-sub'><a href='#'>Sem List</a>
      <ul>
         <li class='has-sub'><a href='sem1.php'>First Sem</a> </li>
		 <li class='has-sub'><a href='#'>Second Sem</a> </li>
		 <li class='has-sub'><a href='#'>Third Sem</a> </li>
		 <li class='has-sub'><a href='#'>Fourth Sem</a> </li>
		 <li class='has-sub'><a href='#'>Fifth Sem</a> </li>
		 <li class='has-sub'><a href='#'>Sixth Sem</a> </li>
		 <li class='has-sub'><a href='#'>Seventh Sem</a> </li>
		 <li class='has-sub'><a href='#'>Eighth Sem</a> </li>
      </ul>
   </li>
   <li><a href='questionpapers.php'>Question Papers</a></li>
   <li><a href='piechart.php'>Statistics</a></li>
   <li><a href='videolist.php'>Videos</a></li>
   <li><a href='aboutus.html'>About</a></li>
 </ul>
</div>
	<div id="wrapper">
   <?php
		if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==True)
		{
			echo '<button id="myButton" class="item1" >Sign Out!!</button>

				<script type="text/javascript">
						document.getElementById("myButton").onclick = function () 
						{
							
							location.href = "signin.php";
						};
				</script>';
		}
		else
		{
			echo '<a class="item1" href="signin.php">Sign in!</a><a class="item2" href="signup.php">Sign up!</a>';
		}
		?>
