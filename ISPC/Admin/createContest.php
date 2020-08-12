<?php
	session_start();
    $name = "";
	$id = "";
    $date = "";
	$semester = "";
	$fee = "";
	$access = "";
    $errors = array();
    
    //connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ISPC');

    
    
    //if the sing up button is clicked
	if(isset($_POST['create'])){
        $name = mysqli_real_escape_string($db, $_POST['name']);
		$id = mysqli_real_escape_string($db, $_POST['id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$semester = mysqli_real_escape_string($db, $_POST['semester']);
		$fee = mysqli_real_escape_string($db, $_POST['fee']);
		$access = mysqli_real_escape_string($db, $_POST['access']);
		
		
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
		
        if(empty($id)){
			array_push($errors, "ID is required!");
		}
		
        if(empty($date)){
			array_push($errors, "Date is required!");
		}
		
		if(empty($semester)){
			array_push($errors, "Semester is required!");
		}
		
		if(empty($fee)){
			array_push($errors, "Fee is required!");
		}
        
        if(empty($access)){
			array_push($errors, "Access is required!");
		}
		
        
        //username and email check
		if(count($errors) == 0){
        $user_check_query = "SELECT * FROM contest WHERE Name='$name' OR ID ='$id' OR Date = ='$date' LIMIT 1";
          $result = mysqli_query($db, $user_check_query);
          $user = mysqli_fetch_assoc($result);
  
          if ($user) { // if user exists
            if ($user['Name'] === $name) {
              array_push($errors, "Name already exists");
            }

            if ($user['ID'] === $id) {
              array_push($errors, "ID already exists");
            }
			
			if ($user['Date'] === $date) {
              array_push($errors, "Date already exists");
            }
          }
		}

		//if there are no error, save user to database
		
		if(count($errors) == 0){
            $createDate = date('m/d/Y', time());
			$sql = "INSERT INTO contest(Name, ID, Semester, Date, Fee, Access, CreateDate) VALUES('$name', '$id', '$semester', '$date', '$fee', '1', '$createDate')";
			mysqli_query($db, $sql);
			header('location: adminIndex.php'); // redirect to homepage
		
		}	
	}
	
?>	


<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Create Contest</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br>ISPC</h3>
					   
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
                            <a href="adminLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
					<br>
                    <div class = "col-md-7 register-right">
                        <h2><br>Create Contest</h2>
                        <form method = "post" action = "createContest.php">
                        <!-- display errors -->
		                <?php include('errors.php')?>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name" placeholder="Contest Name" value = "<?php echo $name; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "id" placeholder="Contest ID" value = "<?php echo $id; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "semester" placeholder="Semester" value = "<?php echo $semester; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "date" placeholder="Date" value = "<?php echo $date; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "fee" placeholder="Fee" value = "<?php echo $fee; ?>">
                            </div>
							 <div class = "form-group">
                                <input type = "text" class = "form-control" name = "access" placeholder="Access(1/0)" value = "<?php echo $access; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "create">Create</button>
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