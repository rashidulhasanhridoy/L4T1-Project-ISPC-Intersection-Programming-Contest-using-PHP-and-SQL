<?php
  //logout
	
	if (isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['userName']);
		header('location: adminLogin.php'); 
	}	




?>