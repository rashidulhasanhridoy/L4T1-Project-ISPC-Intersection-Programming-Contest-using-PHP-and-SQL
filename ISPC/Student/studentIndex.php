<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Student Home</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br>ISPC - Inter Section Programming Contest</h3>
                        <script>
                            document.write(Date());
                        </script>
                        <div class = "content">
                    <?php
					session_start();
					if (isset($_SESSION['success'])): ?>
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
                       <p>Welcome ISPC, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                         <!-- main part------------------------------------------------ -->
                        <p ><?php
                            $name = $_SESSION['userName']; 
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

                            $sql = "SELECT Name, ID, Email, PhoneNumber, Batch, Section, JoinDate FROM studentinfo where UserName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["Name"]."<br>ID: " . $row["ID"]."<br>Email: " . $row["Email"]."<br>Phone Number: " . $row["PhoneNumber"]."<br>Batch: " . $row["Batch"]."<br>Section: " . $row["Section"]."<br>Join Date: " . $row["JoinDate"];

                                }
								
						
                           
							}
							
							else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></p>

                    <?php endif ?>
					
					<?php
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

                            $sql = "SELECT Name, Date FROM contest where Access = '1'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "Upcomming contest : ".$row["Name"]."<br>Contest date : ".$row["Date"];

                                }
                            } else {
                                echo "";
                            }
                            $conn->close();
                            ?>
		</div>
						<p style = "color : blue;">If you are new in this system, you need to set your programming language that you are want to use in contest.
                       <a href="studentSetLanguage.php" style = "color : green;">Set Language!</a></p><br>
                       <a href="studentLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                        <br>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                       <br><br><br><br>
                        <form method = "post" action = "studentIndex.php">
                        <div class = "register-form" >
                            <a href="studentUpdateProfile.php"><button type = "button" class = "btn btn-primary" >Update Profile</button></a>
							<a href="studentChangePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
							<a href="studentLanguage.php"><button type = "button" class = "btn btn-primary" >Update Language</button></a>
							<hr>
							<a href="studentList.php"><button type = "button" class = "btn btn-primary" >Student List</button></a>
							<a href="teamList.php"><button type = "button" class = "btn btn-primary" >Team List</button></a>
							<hr>
							<a href="createTeam.php"><button type = "button" class = "btn btn-primary" >Create Team</button></a>
							<a href="viewTeam.php"><button type = "button" class = "btn btn-primary" >Team Info</button></a>

							<a href="teamRequest.php"><button type = "button" class = "btn btn-primary" >Team Request</button></a>
							<a href="deleteTeam.php"><button type = "button" class = "btn btn-primary" >Delete Team</button></a>
							
                           
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>