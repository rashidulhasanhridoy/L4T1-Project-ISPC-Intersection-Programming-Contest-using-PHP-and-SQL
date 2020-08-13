<?php
	session_start();
	$name = "";
    $userName2 = "";
    $l1 = "";
	$l2 = "";
	$l3 = "";
	$teamName = "";
    
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['select'])){
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
		$sID = mysqli_real_escape_string($db, $_POST['sID']);
        $sql = "SELECT Name, UserName from studentinfo where ID = '$sID'";
		$sql2 = "SELECT L1, L2, L3 from language where UserName = (SELECT UserName from studentinfo where ID = '$sID')";
        $result = mysqli_query($db, $sql);
		$result2 = mysqli_query($db, $sql2);
		
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['Name'];
            $userName2 = $row['UserName'];
          }  
        }
		
		if(mysqli_num_rows($result2) > 0)
        {
          while ($row = mysqli_fetch_array($result2))
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

    else{
        //
    }

?>

<?php
    //confirm Team
	if(isset($_POST['confirmTeam'])){
            $userName11 = $_SESSION['userName'];
            $userName2 = $_POST['userName2'];
            //$teamName = $_POST['teamName'];
			
			
        
		//ensure that the form fields are filled properly
        if(empty($userName2)){
			array_push($errors, "Username is required!");
		}
        $db = mysqli_connect('localhost', 'root', '', 'ISPC');
		
		if(count($errors) == 0){
			$sql = "UPDATE team set Request = '1' where UserName2 = '$userName11'";
			mysqli_query($db, $sql);
            header('location: studentIndex.php');
		}
        
	}

?>


<?php
    //delete Team
	if(isset($_POST['deleteTeam'])){
            $userName11 = $_SESSION['userName'];
            $userName2 = $_POST['userName2'];
            //$teamName = $_POST['teamName'];
			
			
        
		//ensure that the form fields are filled properly
        $db = mysqli_connect('localhost', 'root', '', 'ISPC');
		
		if(count($errors) == 0){
			$sql = "Delete from team where UserName1 = '$userName11' OR UserName2 = '$userName11'";
			mysqli_query($db, $sql);
            header('location: studentIndex.php');
		}
        
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Create Team</title>
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
                        <form method = "post" action = "teamRequest.php">
						
						 <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";
                            $columnName = "ID1";
							$userName = $_SESSION['userName'];
                            $conn = new mysqli($servername, $username, $password, $dbname);
							
							 $user_check_query = "SELECT Request from team where UserName1 = '$userName' OR UserName2 = '$userName'";
							 $result = mysqli_query($conn, $user_check_query);
							 $user = mysqli_fetch_assoc($result);
					  
							  if ($user) { // if user exists
								if ($user['Request'] == '1') {
								  array_push($errors, "Already in a team!");
								}

							  }

							if(count($errors) == 0){
                            $query = "SELECT  ID1 FROM team where UserName2 = '$userName' AND Request = '0'";
                         
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
							<h4>Select a request</h4>
                            
                            <div class = "form-group">
                                <select name = "sID" value = "<?php echo $sID; ?>">
                                    <?php
                                        if($result)
                                        {
                                            while($row = mysqli_fetch_array($result))
                                            { 
                                                $ID = $row["$columnName"];
                                                echo"<option>$ID<br></option>";
                                            }
                                        }
                                    ?>
									<option value = "">0</option>
                                </select>
                            </div>
                            
                            
                     	<button type = "submit" class = "btn btn-primary" name  = "select" onclick="">Continue</button>
							
                            <br>
                            <br>
                            
						
						
						
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Profile Information</h3>
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName2" placeholder="User Name" value = "<?php echo $userName2; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "l1" placeholder="Language 1" value = "<?php echo $l1; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "l2" placeholder="Language 2" value = "<?php echo $l2; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "l3" placeholder="Language 3" value = "<?php echo $l3; ?>">
                            </div>
							<button type = "submit" class = "btn btn-primary" name  = "confirmTeam" onclick="">Confirm</button>
							<button type = "submit" class = "btn btn-primary" name  = "deleteTeam" onclick="">Delete</button>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <br>
</body>
</html>