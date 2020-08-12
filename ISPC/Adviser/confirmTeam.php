<?php
	session_start();
	$teamName = $_SESSION['teamName'];
	$name1 = "";
	$id1 = "";
    $userName1 = $_SESSION['member1'];
	$name2 = "";
	$id2 = "";
    $userName2 = $_SESSION['member2'];
    $batch = "";
	$section = "";
	$teamID = strval(rand());
	$errors = array();
   
		$db = mysqli_connect('localhost', 'root', '', 'ISPC');
        $sql = "SELECT Name, UserName, ID from studentinfo where UserName = '$userName1'";
		$sql2 = "SELECT Name, UserName, ID, Batch, Section from studentinfo where UserName = '$userName2'";
        $result = mysqli_query($db, $sql);
		$result2 = mysqli_query($db, $sql2);
		
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name1 = $row['Name'];
            $userName1= $row['UserName'];
			$id1 = $row['ID'];
          }  
        }
		
		if(mysqli_num_rows($result2) > 0)
        {
          while ($row = mysqli_fetch_array($result2))
          {
            $name2 = $row['Name'];
            $userName2= $row['UserName'];
			$id2 = $row['ID'];
			$section = $row['Section'];
			$batch = $row['Batch'];
          }  
        }
        
        else {
           echo "not found!";
        }
        
        mysqli_free_result($result);
        mysqli_close($db);

?>

<?php
    //update
	if(isset($_POST['createTeam'])){
        $teamName = $_POST['teamName'];
		$name1 = $_POST['name1'];
		$id1 = $_POST['id1'];
		$userName1 = $_POST['userName1'];
		$name2 = $_POST['name2'];
		$id2 = $_POST['id2'];
		$userName2 = $_POST['userName2'];
		$batch = $_POST['batch'];
		$section = $_POST['section'];
		$teamID = $_POST['teamID'];
		  
		
        
		$servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ISPC";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
		
		if(count($errors) == 0){
			$date = date('m/d/Y', time());
			$sql = "INSERT INTO team(TeamName,TeamID,Member1,ID1,UserName1,Member2,ID2,UserName2,Batch,Section,CreatingDate,Request, Approve)
			VALUES('$teamName', '$teamID', '$name1', '$id1', '$userName1', '$name2', '$id2', '$userName2', '$batch', '$section', '$date', '1', '1')";
			$result = mysqli_query($conn, $sql);
			mysqli_close($conn);
            header('location: advisorIndex.php');
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
                        
                        <a href="makeTeamNext.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
						
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "confirmTeam.php">
						
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
                            <button type = "submit" class = "btn btn-primary" name  = "createTeam" onclick="">Confirm</button>
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