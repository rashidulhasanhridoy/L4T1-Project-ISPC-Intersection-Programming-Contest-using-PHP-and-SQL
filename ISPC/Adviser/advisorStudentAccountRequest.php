<?php
	session_start();
	$name = "";
	$ID1 = "";
    $gender = "";
    $userName = "";
    $email = "";
    $phoneNumber = "";
	$batch = "";
	$section = "";
	$errors = array();
    //if the search button is clicked
	if(isset($_POST['selectStudent'])){
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
		$sID = mysqli_real_escape_string($db, $_POST['sID']);
        $userName = $_SESSION['userName'];
        $sql = "SELECT Name, ID, Gender, Email, PhoneNumber, Batch, Section from studentinfo where ID = '$sID'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['Name'];
			$ID1 = $row['ID'];
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
	if(isset($_POST['update'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ISPC');
            $id2 = $_POST['id'];
        
		
		if(count($errors) == 0){
			$sql = "UPDATE studentinfo set Request = '1' WHERE ID = '$id2'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: advisorStudentAccountRequest.php');
		}
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Student Account Request</title>
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
                        <form method = "post" action = "advisorStudentAccountRequest.php">
						
						
						
						
						
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
							OR (Section IN (SELECT Section1 from section where UserName = '$teacher'))) 
							AND Request = '0'";
							 
						
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
							<h4>Select a student</h4>
                            
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
                            <h3>Profile Information</h3>
                        <div class = "register-form" >
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "id" placeholder="ID" value = "<?php echo $ID1; ?>">
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
                           
                            
                            <button type = "submit" class = "btn btn-primary" name  = "update" onclick="">Accepect</button>
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