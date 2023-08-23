<?php

error_reporting(0);
if(isset($_POST['tc']))
{
	$tc=$_POST['tc'];

	
    echo file_get_contents("http://74.235.11.56:3000/api/gsm/$tc");
	

}

?>