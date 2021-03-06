<?php
	session_start();
	$name = "";
    $gender = "";
    $userName = "";
    $email = "";
    $phoneNumber = "";
	$batch = "";
	$section = "";
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['seeProfile'])){
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ISPC');
        $sql = "SELECT Name, Gender, Email, PhoneNumber, Batch, Section from studentinfo where UserName = '$userName'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['Name'];
            $gender = $row['Gender'];
            $email = $row['Email'];
            $phoneNumber = $row['PhoneNumber'];
			$batch = $row['Batch'];
			$section = $row['Section'];
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
    //update profile
	if(isset($_POST['updateProfile'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ISPC');
            $name = $_POST['name1'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
			$batch = $_POST['batch'];
			$section = $_POST['section'];
			$phoneNumber = $_POST['phoneNumber'];
			
        
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
        if(empty($gender)){
			array_push($errors, "Gender is required!");
		}
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
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
		if(count($errors) == 0){
			$sql = "UPDATE studentinfo set Name = '$name', Gender = '$gender', PhoneNumber = '$phoneNumber', Email = '$email', Section = '$section', Batch = '$batch' WHERE UserName = '$userName'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: studentIndex.php');
		}
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Update Profile</title>
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
                        <form method = "post" action = "studentUpdateProfile.php">
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h3>Profile Information</h3>
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "gender" placeholder="Gender" value = "<?php echo $gender; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "batch" placeholder="Batch" value = "<?php echo $batch; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "section" placeholder="Section" value = "<?php echo $section; ?>">
                            </div>
                            <button type = "submit" class = "btn btn-primary" name  = "seeProfile">See Profile</button>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "updateProfile" onclick="">Update</button>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>