<!doctype html>
<html>
<head>
    <title>Pie Chart </title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>

<?php
    //include the library
    include "libchart/libchart/classes/libchart.php";
	$val=$_POST['type'];

    //new pie chart instance
    $chart = new PieChart( 500, 300 );

    //data set instance
    $dataSet = new XYDataSet();
   
    //actual data
    //get data from the database
   
    //include database connection
    include 'connect.php';

    //query all records from the database
   // $query = "select users.user_name,count(*) from posts,users where users.user_id=posts.post_by group by post_by";
    if($val==1)
	{
		$sql = "select users.user_name,count(*) as coun from posts,users where users.user_id=posts.post_by group by post_by";
		
		$con=mysqli_connect($server, $username, $password,$database);
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);

		//execute the query
		//    $result = $mysqli->query( $query );

		//get number of rows returned
		//  $num_results = $result->num_rows;

		if( $result){
	   
			while( $row = mysqli_fetch_assoc($result) ){
				extract($row);
				$dataSet->addPoint(new Point("{$user_name}", $coun));
			}
	   
			//finalize dataset
			$chart->setDataSet($dataSet);

			//set chart title
			$chart->setTitle("Users activity in Student Teacher Portal!");
		   
			//render as an image and store under "generated" folder
			$chart->render("generated/1.png");
	   
			//pull the generated chart where it was stored
			echo "<img alt='Pie chart'  src='generated/1.png' style='border: 2px solid gray;' height='420' width='550' align='top'/>";
	   
		}else{
			echo "No users activity.";
		}
	}
	else
	{
		$sql="select topics.topic_subject,count(*) as coun from topics,posts where topics.topic_id=posts.post_topic group by post_topic";
		$con=mysqli_connect($server, $username, $password,$database);
		$result = mysqli_query(mysqli_connect($server, $username, $password,$database),$sql);

		if( $result){
	   
			while( $row = mysqli_fetch_assoc($result) ){
				extract($row);
				$dataSet->addPoint(new Point("{$topic_subject}", $coun));
			}
	   
			//finalize dataset
			$chart->setDataSet($dataSet);

			//set chart title
			$chart->setTitle("Subjects activity in Student Teacher Portal!");
		   
			//render as an image and store under "generated" folder
			$chart->render("generated/1.png");
	   
			//pull the generated chart where it was stored
			echo "<img alt='Pie chart'  src='generated/1.png' style='border: 2px solid gray;' height='420' width='550' align='top'/>";
	   
		}else{
			echo "No activity.";
		}
		
	}
	
	
	
?>

</body>
</html>