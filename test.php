<?php 

	date_default_timezone_set("Asia/Kolkata");
	echo date("G:i");
	echo "<br>";
	if(date("G:i") >= "18:00" && date("G:i")<="23:00")
	{
		echo "date";
	}
	else
	{
			echo "out";
	}
?>