<?php
	$l1 = "";
	$l2 = "";
	$l3 = "";
	session_start();
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['seeLanguage'])){
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
		$l1 = mysqli_real_escape_string($db, $_POST['l1']);
		$l2 = mysqli_real_escape_string($db, $_POST['l2']);
		$l3 = mysqli_real_escape_string($db, $_POST['l3']);
        $userName = $_SESSION['userName'];
        $sql = "INSERT INTO language(UserName, L1, L2, L3) VALUES('$userName','$l1', '$l2', '$l3')";
        $result = mysqli_query($db, $sql);
        mysqli_close($db);
		header('location: studentIndex.php');
		
	}
?>


<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Set Language</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br>ISPC</h3>
                        <script>
                            document.write(Date());
                        </script>
                        <div class = "content">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class = "error success">
                            <h3>
                                <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </h3>
                        </div>

                    <?php endif ?>
                    <!-- welcome -->
                    <?php  if (isset($_SESSION['userName'])) : ?>
                       <p>Welcome user, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                         <!-- main part------------------------------------------------ -->
                       

                            <!-- logout -->
                            <a href="studentLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="studentIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "studentSetLanguage.php">
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Set Language</h3>
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "l1" placeholder="Language 1" value = "<?php echo $l1; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "l2" placeholder="Language 2" value = "<?php echo $l2; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "l3" placeholder="Language 3" value = "<?php echo $l3; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "seeLanguage">Save</button>
      
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>