<?php
	$l1 = "";
	$l2 = "";
	$l3 = "";
	session_start();
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['seeLanguage'])){
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ISPC');
        $sql = "SELECT L1, L2, L3 from language where UserName = '$userName'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $l1 = $row['L1'];
            $l2 = $row['L2'];
			$l3 = $row['L3'];
          }  
        }
        
        else {
           echo "not found!";
        }
        
        mysqli_free_result($result);
        mysqli_close($db);
        
	}

  

?>

<?php
    //update
	if(isset($_POST['updateLanguage'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ISPC');
            $l1 = $_POST['l1'];
            $l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			
        
		//ensure that the form fields are filled properly
        if(empty($l1)){
			array_push($errors, "Language 1 is required!");
		}
		if(empty($l2)){
			array_push($errors, "Language 2 is required!");
		}
		if(empty($l3)){
			array_push($errors, "Language 3 is required!");
		}
        
		if(count($errors) == 0){
			$sql = "UPDATE language set L1 = '$l1', L2 = '$l2', L3 = '$l3' where UserName = '$userName'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: studentIndex.php');
		}
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Update Language</title>
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
                        <form method = "post" action = "studentLanguage.php">
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Update Language</h3>
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
                            
                            <button type = "submit" class = "btn btn-primary" name  = "seeLanguage">See Language</button>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "updateLanguage" onclick="">Update</button>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>