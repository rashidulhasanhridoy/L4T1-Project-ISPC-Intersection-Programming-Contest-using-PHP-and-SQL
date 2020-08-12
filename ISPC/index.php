<!DOCTYPE html>
<html>
<head>
    <title>Welcome to ISPC</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br>ISPC - Inter Section Programming Contest</h3>
                       <p>Eat Code Sleep Repeat!</p>
                       <a href = "Admin/adminLogin.php">Are you a admin?<br>Click here!</a>
                       <br>
                       <a href = "Adviser/advisorLogin.php">Are you a advisor?<br>Click here!</a> 
					   <br>
					   <a href = "Student/studentLogin.php">Are you a student?<br>Click here!</a>
					   <br>
					   
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

                            $sql = "SELECT count(ID) FROM userinfo";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(ID)"]." Users!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
					   
					   
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

                            $sql = "SELECT count(Name) FROM admininfo";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(Name)"]." Admins!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
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

                            $sql = "SELECT count(Name) FROM studentinfo";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(Name)"]." Students!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							
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

                            $sql = "SELECT count(Name) FROM advisorinfo";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(Name)"]." Advisors!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							
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

                            $sql = "SELECT count(TeamName) FROM team";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(TeamName)"]." Teams!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							
							
							
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

                            $sql = "SELECT count(Name) FROM contest";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(Name)"]." Contests!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
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
                                    echo "<br><br>Upcomming contest : ".$row["Name"]."<br>Contest date : ".$row["Date"];

                                }
                            } else {
                                echo "";
                            }
                            $conn->close();
                            ?>
							
							<br><br>
							<script>
                            document.write(Date());
                        </script>
						
						
						
                        
                        
                        
                    </div>
					<br>
                    <div class = "col-md-7 register-right">
                        
                        <form method = "post" action = "index.php">
                       
                        <div class = "register-form" >
                        <br><br>
                            
                        <img src = "contest.jpeg" height= "520px";>  
                         
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>