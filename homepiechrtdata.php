<?php

//data.php

$conn = new PDO("mysql:host=localhost;dbname=mycareer_mycareersportal", "mycareers_user", "CaRR3rP0rta1!$");
 date_default_timezone_set("Asia/colombo");
$date = date("Y-m-d");  
$month =date("m",strtotime($date));
if(isset($_POST["action"]))
{
    /*-------------------------------------------------------------- Today-----------------------------------------------------------------------*/ 
    
    if($_POST["action"] == 'today')
	{

	
		$query = "
		SELECT `feedback`, COUNT(`id`) AS Total FROM candidate_summery where date = '$date' AND `user_id`= '".$_POST["post_id"]."'  GROUP BY `feedback`
		";

		$result = $conn->query($query);

		$data = array();

		foreach($result as $row)
		{
		    	$feed = $row['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
                        
			$data[] = array(
				'language'		=>	$words,
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
	
	/*-------------------------------------------------------------- Weeks -----------------------------------------------------------------------*/ 
    
    if($_POST["action"] == 'week')
	{

	
		$query = "
		SELECT `feedback`, COUNT(`id`) AS Total FROM candidate_summery where WEEK(`date`) = WEEK(CURDATE())  AND `user_id`= '".$_POST["post_id"]."'  GROUP BY `feedback`
		";

		$result = $conn->query($query);

		$data = array();

		foreach($result as $row)
		{
		    $feed = $row['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
                
			$data[] = array(
				'language'		=>	$words,
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
	/*--------------------------------------------------------------Month-----------------------------------------------------------------------*/ 
	
	   
    if($_POST["action"] == 'month')
	{

	
		$query = "
		SELECT `feedback`, COUNT(`id`) AS Total FROM candidate_summery where MONTH(date) = MONTH(CURDATE()) AND `user_id`= '".$_POST["post_id"]."'  GROUP BY `feedback`
		";

		$result = $conn->query($query);

		$data = array();

		foreach($result as $row)
		{
		     $feed = $row['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
                
			$data[] = array(
				'language'		=>	$words,
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
	
	/*--------------------------------------------------------------Year-----------------------------------------------------------------------*/ 
	   
    if($_POST["action"] == 'year')
	{

	
		$query = "
  	SELECT `feedback`, COUNT(`id`) AS Total FROM candidate_summery where year(`date`) = year(now()) AND `user_id`='".$_POST["post_id"]."'  GROUP BY `feedback`
		";

		$result = $conn->query($query);

		$data = array();

		foreach($result as $row)
		{
		     $feed = $row['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
			$data[] = array(
				'language'		=>	$words,
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
	
    /*--------------------------------------------------------------ALL DATA-----------------------------------------------------------------------*/ 
     if($_POST["action"] == 'fetch')
	{
	
		$query = "
		SELECT `feedback`, COUNT(`id`) AS Total FROM candidate_summery where week(`date`) = week(now()) AND `user_id`= '".$_POST["post_id"]."'  GROUP BY `feedback`
		";

		$result = $conn->query($query);

		$data = array();

		foreach($result as $row)
		{
		     $feed = $row['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
			$data[] = array(
				'language'		=>	$words,
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}

}


?>