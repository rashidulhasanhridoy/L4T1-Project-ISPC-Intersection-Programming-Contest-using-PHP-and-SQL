<?php
	session_start();
	$teamName = "";
	$name1 = "";
	$id1 = "";
    $userName1 = "";
	$name2 = "";
	$id2 = "";
    $userName2 = "";
    $batch = "";
	$section = "";
	$teamID = "";
	$errors = array();
	
	if(isset($_POST['selectteam'])){
		$teamID = $_POST['sID'];
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
        $sql = "SELECT TeamID, Member1, TeamName, ID1, UserName1, Member2, ID2, UserName2, Batch, Section from team 
		where TeamID = '$teamID'";
        $result = mysqli_query($db, $sql);

		
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
				$teamName = $row['TeamName'];
				$name1 = $row['Member1'];
				$id1 = $row['ID1'];
				$userName1 = $row['UserName1'];
				$name2 = $row['Member2'];
				$id2 = $row['ID2'];
				$userName2 = $row['UserName2'];
				$batch = $row['Batch'];
				$section = $row['Section'];
				$teamID = $row['TeamID'];
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
	if(isset($_POST['approveTeam'])){
            $teamID = $_POST['teamID'];
            
			
			
        
		//ensure that the form fields are filled properly
        $db = mysqli_connect('localhost', 'root', '', 'ISPC');
		
		if(count($errors) == 0){
			$sql = "Update team set Approve = '1' where TeamID = '$teamID'";
			mysqli_query($db, $sql);
            header('location: adminIndex.php');
		}
        
	}

?>


<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Approve Team</title>
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
                        <form method = "post" action = "approveTeam.php">
						
						 <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";
                            $columnName = "TeamID";
							$teacher = $_SESSION['userName'];
                            $conn = new mysqli($servername, $username, $password, $dbname);
							

							if(count($errors) == 0){
                            $query = "SELECT  TeamID FROM team where 
							Request = '1'
							AND Approve = '0'";
                         
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
							<br><h4>Select a team</h4>
                            
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
                            
                            
                     	<button type = "submit" class = "btn btn-primary" name  = "selectteam" onclick="">Search</button>
							
                            <br>
                            <br>
                        </form>
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "approveTeam.php">
						
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h4>Team Information</h4>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "teamName" placeholder="Team name" value = "<?php echo $teamName; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "teamID" placeholder="Team ID" value = "<?php echo $teamID; ?>">
                            </div>
							
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name1; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName1" placeholder="Username" value = "<?php echo $userName1; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "id1" placeholder="ID" value = "<?php echo $id1; ?>">
                            </div>
							
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "name2" placeholder="Name" value = "<?php echo $name2; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName2" placeholder="Username" value = "<?php echo $userName2; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "id2" placeholder="ID" value = "<?php echo $id2; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "batch" placeholder="Batch" value = "<?php echo $batch; ?>">
                            </div>
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "section" placeholder="Section" value = "<?php echo $section; ?>">
                            </div>
							
							<button type = "submit" class = "btn btn-primary" name  = "approveTeam" onclick="">Approve</button>
                            
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