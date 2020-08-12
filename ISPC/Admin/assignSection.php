<?php
	session_start();
	$name = "";
	$UserName = "";
	$batch = "";
	$id = "";
    $section1 = "";
	$section2 = "";
	$section3 = "";
	$section4 = "";
	$section5 = "";
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['select'])){
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
		$sID = mysqli_real_escape_string($db, $_POST['sID']);
        $sql = "SELECT Name, UserName, ID, Batch, Section1, Section2, Section3, Section4, Section5 from section where ID = '$sID'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['Name'];
			$UserName = $row['UserName'];
			$id = $row['ID'];
			$batch = $row['Batch'];
			$section1 = $row['Section1'];
			$section2 = $row['Section2'];
			$section3 = $row['Section3'];
			$section4 = $row['Section4'];
			$section5 = $row['Section5'];
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
	if(isset($_POST['assign'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ISPC');
            $name = $_POST['name1'];
            $userName = $_POST['UserName'];
			$id = $_POST['id'];
			$batch = $_POST['batch'];
			$section1 = $_POST['section1'];
			$section2 = $_POST['section2'];
			$section3 = $_POST['section3'];
			$section4 = $_POST['section4'];
			$section5 = $_POST['section5'];
			
			//ensure that the form fields are filled properly
		
		
        if(empty($batch)){
			array_push($errors, "Batch is required!");
		}
        
        
        
         if(count($errors) == 0){
			
			$sql = "UPDATE section set Name = '$name', UserName = '$userName', ID = '$id', Batch = '$batch', Section1 = '$section1', Section2 = '$section2', Section3 = '$section3', Section4 = '$section4', Section5 = '$section5' where ID = '$id'";
			mysqli_query($db, $sql);
			header('location: assignSection.php');
		
		}	
        
	}
    

?>
<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Assign Section</title>
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
                            <a href="adminLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "assignSection.php">
						
						
						
						
						
						 <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";
                            $columnName = "ID";
                            $conn = new mysqli($servername, $username, $password, $dbname);
							
							 $user_check_query = "SELECT * FROM advisorinfo where Request = '1'";
							 $result = mysqli_query($conn, $user_check_query);
							 $user = mysqli_fetch_assoc($result);

							if(count($errors) == 0){
                            $query = "Select distinct ID From advisorinfo where Request = '1'";
							 
						
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
							<h4>Search a advisor</h4>
                            
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
                            <h3>Assign Section</h3>
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "UserName" placeholder="Username" value = "<?php echo $UserName; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "id" placeholder="ID" value = "<?php echo $id; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "batch" placeholder="Batch" value = "<?php echo $batch; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section1" placeholder="Section 1" value = "<?php echo $section1; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section2" placeholder="Section 2" value = "<?php echo $section2; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section3" placeholder="Section 3" value = "<?php echo $section3; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section4" placeholder="Section 4" value = "<?php echo $section4; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section5" placeholder="Section 5" value = "<?php echo $section5; ?>">
                            </div>
							
                           
                            <button type = "submit" class = "btn btn-primary" name  = "assign" onclick="">Assign</button>
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