<?php
	session_start();
	$name = "";
	$UserName = "";
    $newPassword = "";
	$confirmPassword = "";
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['selectStudent'])){
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
		$sID = mysqli_real_escape_string($db, $_POST['sID']);
        $userName = $_SESSION['userName'];
        $sql = "SELECT Name, UserName from studentinfo where ID = '$sID'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['Name'];
			$UserName = $row['UserName'];
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
    //update
	if(isset($_POST['update'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ISPC');
            $name = $_POST['name1'];
            $userName = $_POST['UserName'];
            $newPassword = $_POST['newPassword'];
			$confirmPassword = $_POST['confirmPassword'];
			
			//ensure that the form fields are filled properly
		
		
        if(empty($newPassword)){
			array_push($errors, "New password is required!");
		}
        if(empty($confirmPassword)){
			array_push($errors, "Comfirm password is required!");
		}
        if($newPassword != $confirmPassword){
			array_push($errors, "Password do not match!");
		}
        
        
        
        
         if(count($errors) == 0){
			$password = md5($newPassword);//encrypt password
			$sql = "UPDATE studentinfo set Password = '$password' where UserName = '$userName'";
			mysqli_query($db, $sql);
			header('location: advisorIndex.php'); // redirect to homepage
		
		}	
        
	}
    

?>
<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Change Password</title>
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
                            <a href="advisorLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="advisorIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "advisorChangeStudentPassword.php">
						
						
						
						
						
						 <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";
                            $columnName = "ID";
							$teacher = $_SESSION['userName'];
                            $conn = new mysqli($servername, $username, $password, $dbname);
							
							 $user_check_query = "SELECT * FROM studentinfo";
							 $result = mysqli_query($conn, $user_check_query);
							 $user = mysqli_fetch_assoc($result);

							if(count($errors) == 0){
                            $query = "Select ID From studentinfo where 
							Batch = (SELECT Batch from section where UserName = '$teacher')
							AND ((Section IN (SELECT Section5 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section4 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section3 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section2 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section1 from section where UserName = '$teacher')))";
							 
						
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
							<h4>Search a student</h4>
                            
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
                            
                            
                     	<button type = "submit" class = "btn btn-primary" name  = "selectStudent" onclick="">Continue</button>
							
                            <br>
                            <br>
                            <br>
						
						
						
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Change Password</h3>
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "UserName" placeholder="Username" value = "<?php echo $UserName; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "newPassword" placeholder="Enter new password" value = "<?php echo $newPassword; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "confirmPassword" placeholder="Confirm new password" value = "<?php echo $confirmPassword; ?>">
                            </div>
                           
                            
                            <button type = "submit" class = "btn btn-primary" name  = "update" onclick="">Update</button>
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