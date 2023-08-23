<?php

error_reporting(0);
if(isset($_POST['tc']))
{
	$tc=$_POST['tc'];

	
    echo file_get_contents("http://217.195.197.150/gotlalesi/aile.php?tc=$tc&auth_key=w4ferzz");
	

}

?>