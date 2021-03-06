<!-- Change Password -->
<?php
	 session_start();
     $userName = $_SESSION['userName'];
     $oldPassword = "";
     $newPassword = "";
     $confirmPassword = "";
     $errors = array();
     $db = mysqli_connect('localhost', 'root', '', 'ISPC');
	if(isset($_POST['changePassword'])){
        $oldPassword = mysqli_real_escape_string($db, $_POST['oldPassword']);
        $newPassword = mysqli_real_escape_string($db, $_POST['newPassword']);
        $confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);
        
        //ensure that the form fields are filled properly
		if(empty($oldPassword)){
			array_push($errors, "Old password is required!");
		}
        if(empty($newPassword)){
			array_push($errors, "New password is required!");
		}
        if(empty($confirmPassword)){
			array_push($errors, "Comfirm password is required!");
		}
		
		if(count($errors) == 0){
        if($newPassword != $confirmPassword){
			array_push($errors, "Password do not match!");
		}
        if($oldPassword == $newPassword){
			array_push($errors, "You can't use old password as new password!");
		}
        
        $user_check_query = "SELECT * FROM studentinfo WHERE UserName = '$userName' LIMIT 1";
          $result = mysqli_query($db, $user_check_query);
          $user = mysqli_fetch_assoc($result);
  
          if ($user) { // if user exists
            if ($user['Password'] != md5($oldPassword)) {
              array_push($errors, "Old password does not match!");
            }

          }
        
        
         if(count($errors) == 0){
			$password = md5($newPassword);//encrypt password
			$sql = "UPDATE studentinfo set Password = '$password' where UserName = '$userName'";
			mysqli_query($db, $sql);
			header('location: studentLogin.php'); 
		
		}
		
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
                            <a href="studentLogin.php?logout='1'" style="color: red;"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                         <a href="studentIndex.php"><button type = "button" class = "btn btn-primary">Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "studentChangePassword.php">
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Change Password</h3>
                        <div class = "register-form" >
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "oldPassword" placeholder="Enter old password" value = "<?php echo $oldPassword; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "newPassword" placeholder="Enter new password" value = "<?php echo $newPassword; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "confirmPassword" placeholder="Confirm new password" value = "<?php echo $confirmPassword; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "changePassword" onclick="">Change Password</button>
                            
                             
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
     
</body>
</html>