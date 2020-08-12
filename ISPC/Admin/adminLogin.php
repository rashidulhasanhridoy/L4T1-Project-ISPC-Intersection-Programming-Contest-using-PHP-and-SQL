<?php
	session_start();
    $userName = "";
    $password = "";
    $errors = array();
    
    //connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ISPC');

 if(isset($_POST['login'])){
        
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		
		//ensure that the form fields are filled properly
		if(empty($userName)){
			array_push($errors, "Username is required!");
		}
		
		if(empty($password)){
			array_push($errors, "Password is required!");
		}
        
        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM admininfo WHERE UserName = '$userName' AND Password = '$password' AND Request = '1'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                //log user
                $_SESSION['userName'] = $userName;
				$_SESSION['success'] = "You are now logged in!";
			    header('location: adminIndex.php'); // redirect to homepage
                
            }
            
            else{
                array_push($errors, "Wrong username or password!");  
            }
        }
    }
	
    
    
    
	
?>	


<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Admin Login</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br>ISPC - Inter Section Programming Contest</h3>
					   <h3><br>Hi, Admin!</h3>
                       <p>Eat Code Sleep Repeat!<br>Don't have a account?</p>
                       <a href = "adminRegistration.php"><button type = "button" class = "btn btn-primary" >Sing Up</button></a>
                        <br><br>
                        <a href = "../index.php"><button type = "button" class = "btn btn-primary" >Home</button></a>
                        
                        
                    </div>
					<br>
                    <div class = "col-md-7 register-right">
                        <h2><br>Login Now!</h2>
                        <form method = "post" action = "adminLogin.php">
                        <!-- display errors -->
		                <?php include('errors.php')?>
                        <div class = "register-form" >
                           
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Username" value = "<?php echo $userName; ?>">
                            </div>
                            
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password"
                                       placeholder="Password">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "login">Login</button>
                            <br><br>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>