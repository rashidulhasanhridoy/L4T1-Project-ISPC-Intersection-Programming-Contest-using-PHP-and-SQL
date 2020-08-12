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
           echo "<h3>Language is not set yet!</h3>";
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
	if(isset($_POST['createTeam'])){
			$userName1 = $_SESSION['member1'];
			$teamName = $_SESSION['teamName'];
            $userName2 = $_POST['userName2'];
            
			
			
        
		//ensure that the form fields are filled properly
        if(empty($userName2)){
			array_push($errors, "Username is required!");
		}
        
		
		if(count($errors) == 0){
			$_SESSION['member1'] = $userName1;
			$_SESSION['member2'] = $userName2;
			$_SESSION['teamName'] = $teamName;
            header('location: confirmTeam.php');
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
                            <a href="advisorLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="makeTeam.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "makeTeamNext.php">
						
						
						
						
						
						 <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";
                            $columnName = "ID";
							$teacher = $_SESSION['userName'];
							$member01 = $_SESSION['member1'];
                            $conn = new mysqli($servername, $username, $password, $dbname);
							
							
							if(count($errors) == 0){
                            $query = "SELECT  ID FROM studentinfo where Request = '1' AND
							Batch = (SELECT Batch from section where UserName = '$teacher')
							AND ((Section IN (SELECT Section5 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section4 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section3 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section2 from section where UserName = '$teacher'))
							OR (Section IN (SELECT Section1 from section where UserName = '$teacher')))
							AND ID NOT IN (SELECT ID1 from Team)
							AND ID NOT IN (SELECT ID2 from Team)
							AND UserName <> '$member01'";
                         
							 
						
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
                           
                            <button type = "submit" class = "btn btn-primary" name  = "createTeam" onclick="">Next</button>
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