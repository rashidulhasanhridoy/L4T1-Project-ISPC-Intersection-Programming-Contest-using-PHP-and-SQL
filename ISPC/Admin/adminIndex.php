<!DOCTYPE html>
<html>
<head>
    <title>ISPC | Admin Home</title>
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

                            $sql = "SELECT Name, ID, Email, PhoneNumber, JoinDate FROM admininfo where UserName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["Name"]."<br>ID: " . $row["ID"]."<br>Email: " . $row["Email"]."<br>Phone Number: " . $row["PhoneNumber"]."<br>Join Date: " . $row["JoinDate"];

                                }
								
						
                           
							}
							
							else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></p>

                    <?php endif ?>
		</div>
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
                  
                       <br><br>
                       <a href="adminLogin.php"><button type = "button" class = "btn btn-primary" >Logout</button></a>
                        <br>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                       <br><br><br><br>
                        <form method = "post" action = "studentIndex.php">
                        <div class = "register-form" >
                            <a href="adminUpdateProfile.php"><button type = "button" class = "btn btn-primary" >Update Profile</button></a>
							<a href="adminChangePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
							<hr>
							<a href="adminUpdateStudentProfile.php"><button type = "button" class = "btn btn-primary" >Update Student Profile</button></a>
							<a href="adminChangeStudentPassword.php"><button type = "button" class = "btn btn-primary" >Change Student Password</button></a>
							<br><br><a href="adminStudentAccountRequest.php"><button type = "button" class = "btn btn-primary" >Student Account Request</button></a>
							<a href="studentList.php"><button type = "button" class = "btn btn-primary" >Student List</button></a>
							<a href="adminSearchStudent.php"><button type = "button" class = "btn btn-primary" >Search Student</button></a>
							<hr>
							<a href="adminUpdateAdvisorProfile.php"><button type = "button" class = "btn btn-primary" >Update Advisor Profile</button></a>
							<a href="adminChangeAdvisorPassword.php"><button type = "button" class = "btn btn-primary" >Change Advisor Password</button></a>
							<br><br>
							<a href="adminAdvisorRequestAccount.php"><button type = "button" class = "btn btn-primary" >Advisor Account Request</button></a>
							<a href="advisorList.php"><button type = "button" class = "btn btn-primary" >Advisor List</button></a>
							<a href="adminSearchAdvisor.php"><button type = "button" class = "btn btn-primary" >Search Advisor</button></a>
							<hr>
							<a href="adminAccountRequest.php"><button type = "button" class = "btn btn-primary" >Admin Account Request</button></a>
							<a href="adminList.php"><button type = "button" class = "btn btn-primary" >Admin List</button></a>
							<hr>
							<a href="sectionList.php"><button type = "button" class = "btn btn-primary" >Section List</button></a>
							<a href="assignSection.php"><button type = "button" class = "btn btn-primary" >Assign Section</button></a>
							<a href="assignSectionList.php"><button type = "button" class = "btn btn-primary" >Assign Section List</button></a>
							<hr>
							<a href="teamList.php"><button type = "button" class = "btn btn-primary" >Team List</button></a>
							<a href="searchTeam.php"><button type = "button" class = "btn btn-primary" >Search Team</button></a>
							
							<a href="approveTeam.php"><button type = "button" class = "btn btn-primary" >Approve Team</button></a>
							<a href="deleteTeam.php"><button type = "button" class = "btn btn-primary" >Delete Team</button></a>
							<hr>
							<a href="createContest.php"><button type = "button" class = "btn btn-primary" >Create Contest</button></a>
							<a href="updateContest.php"><button type = "button" class = "btn btn-primary" >Update Contest</button></a>

							<a href="contestList.php"><button type = "button" class = "btn btn-primary" >Contest List</button></a>
							<br>
							<br>
							
							
                        </div>
						
						
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>