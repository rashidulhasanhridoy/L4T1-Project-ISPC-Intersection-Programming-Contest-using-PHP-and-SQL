<?php
	session_start();
    $name = "";
	$id = "";
    $gender = "";
    $userName = "";
    $email = "";
    $phoneNumber = "";
	$batch = "";
	$section = "";
    $errors = array();
    
    //connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ISPC');

    
    
    //if the sing up button is clicked
	if(isset($_POST['signUp'])){
        $name = mysqli_real_escape_string($db, $_POST['name']);
		$id = mysqli_real_escape_string($db, $_POST['id']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
		$batch = mysqli_real_escape_string($db, $_POST['batch']);
		$section = mysqli_real_escape_string($db, $_POST['section']);
		$password1 = mysqli_real_escape_string($db, $_POST['password1']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);
		
		
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
		
        if(empty($id)){
			array_push($errors, "ID is required!");
		}
		
        if(empty($gender)){
			array_push($errors, "Gender is required!");
		}
		
		if(empty($userName)){
			array_push($errors, "Username is required!");
		}
		
		if(empty($email)){
			array_push($errors, "Email is required!");
		}
		if(empty($batch)){
			array_push($errors, "Batch is required!");
		}
		if(empty($section)){
			array_push($errors, "Section is required!");
		}
        
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
		}
		
		if(empty($password1)){
			array_push($errors, "Password is required!");
		}

		if($password1 != $password2){
			array_push($errors, "The password do not match!");
		}
        
        
        //username and email and id check
        $user_check_query = "SELECT * FROM userinfo WHERE UserName='$userName' OR Email='$email' OR ID = '$id' LIMIT 1";
          $result = mysqli_query($db, $user_check_query);
          $user = mysqli_fetch_assoc($result);
  
          if ($user) { // if user exists
            if ($user['UserName'] === $userName) {
              array_push($errors, "Username already exists");
            }

            if ($user['Email'] === $email) {
              array_push($errors, "Email already exists");
            }
			
			if ($user['ID'] === $id) {
              array_push($errors, "ID already exists");
            }
          }

		//if there are no error, save user to database
		
		if(count($errors) == 0){
            $joinDate = date('m/d/Y', time());
			$password = md5($password1);//encrypt password
			$sql = "INSERT INTO studentinfo(JoinDate, ID, UserName, Name, Gender, Email, PhoneNumber, Section, Batch, Password, Request) VALUES('$joinDate', '$id', '$userName', '$name', '$gender', '$email', '$phoneNumber', '$section', '$batch', '$password', '0')";
			$sql2 = "INSERT INTO userinfo(ID, UserName, Email) VALUES('$id', '$userName', '$email')";
			mysqli_query($db, $sql);
			mysqli_query($db, $sql2);
             $_SESSION['userName'] = $userName;
			 $_SESSION['success'] = "Account successfully created.You are now logged in!";
			header('location: studentLogin.php');
		
		}	
	}
	
?>	


<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Student Sign Up</title>
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
                       <p>Eat Code Sleep Repeat!<br>Already have a account?</p>
                       <a href = "studentLogin.php"><button type = "button" class = "btn btn-primary" >Login</button></a>
                        <br><br>
                        <a href = "../index.php"><button type = "button" class = "btn btn-primary" >Home</button></a>
                        
                        
                    </div>
					<br>
                    <div class = "col-md-7 register-right">
                        <h2><br>Sign Up Now!</h2>
                        <form method = "post" action = "studentRegistration.php">
                        <!-- display errors -->
		                <?php include('errors.php')?>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "id" placeholder="ID" value = "<?php echo $id; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "gender" placeholder="Gender" value = "<?php echo $gender; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Username" value = "<?php echo $userName; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "batch" placeholder="Batch Number" value = "<?php echo $batch; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "section" placeholder="Section" value = "<?php echo $section; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password1"
                                       placeholder="Password">
                            </div>
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password2"
                                       placeholder="Confirm Password">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "signUp">Sign Up</button>
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