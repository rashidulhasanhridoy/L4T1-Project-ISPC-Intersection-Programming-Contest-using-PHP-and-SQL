<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Advisor Home</title>
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

                            $sql = "SELECT Name, ID, Email, PhoneNumber, JoinDate FROM advisorinfo where UserName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["Name"]."<br>ID: " . $row["ID"]."<br>Email: " . $row["Email"]."<br>Phone Number: " . $row["PhoneNumber"]."<br>Join Date: " . $row["JoinDate"];

                                }
								
						
                           
							}
							
							$sql2 = "SELECT Batch, Section1, Section2, Section3, Section4, Section5 FROM section where UserName = '$name'";
                            $result2 = $conn->query($sql2);
							
							if ($result2->num_rows > 0) {
                                // output data of each row
                                while($row = $result2->fetch_assoc()) {
                                    echo "<br>Batch: " . $row["Batch"]."<br>Section 1: " . $row["Section1"]."<br>Section 2: " . $row["Section2"]."<br>Section 3: " . $row["Section3"]."<br>Section 4: " . $row["Section4"]."<br>Section 5: " . $row["Section5"];;

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
                  
                       <br>
                       <a href="advisorLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                        <br>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                       <br><br><br><br>
                        <form method = "post" action = "studentIndex.php">
                        <div class = "register-form" >
                            <a href="advisorUpdateProfile.php"><button type = "button" class = "btn btn-primary" >Update Profile</button></a>
							<a href="advisorChangePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
							<hr>
							<a href="advisorUpdateStudentProfile.php"><button type = "button" class = "btn btn-primary" >Update Student Profile</button></a>
							<a href="advisorChangeStudentPassword.php"><button type = "button" class = "btn btn-primary" >Change Student Password</button></a>
							<br><br><a href="advisorStudentAccountRequest.php"><button type = "button" class = "btn btn-primary" >Student Account Request</button></a>
							<a href="studentList.php"><button type = "button" class = "btn btn-primary" >Student List</button></a>
							<hr>
							<a href="teamList.php"><button type = "button" class = "btn btn-primary" >Team List</button></a>
							<a href="makeTeam.php"><button type = "button" class = "btn btn-primary" >Make Team </button></a>
							<a href="deleteTeam.php"><button type = "button" class = "btn btn-primary" >Delete Team </button></a>
							<a href="approveTeam.php"><button type = "button" class = "btn btn-primary" >Approve Team </button></a>
							<hr>
							<a href="contestList.php"><button type = "button" class = "btn btn-primary" >Contest</button></a>
							
                           
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>