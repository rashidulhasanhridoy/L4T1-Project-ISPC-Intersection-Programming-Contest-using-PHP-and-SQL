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


<!DOCTYPE html>
<html>
	<head>
		<title>ISPC | Student List</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 18px;
           text-align: center;
             } 
          th,td {
           background-color: white;
           color: #2E86C1;
		   border: 1px solid;
            }
			
          tr:nth-child(even) {background-color: #f2f2f2}
        </style>
	</head>
    
		
	<body>
        <br>
         <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                   
                    <div class = "col-md-7 register-right">
                        <h5>Student List</h5>
                        <?php
						session_start();
						$userName = $_SESSION['userName'];
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
                        //$name = $_SESSION['userName'];
                        $sql = "SELECT Name, ID, Gender, Email, PhoneNumber, Section, Batch FROM studentinfo where Section = (Select Section from studentinfo where UserName = '$userName') AND Batch = (Select Batch from studentinfo where UserName = '$userName') AND Request = '1'";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Name</th>
									<th>ID</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
									<th>Batch</th>
									<th>Section</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["ID"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["PhoneNumber"]. "</td><td>" . $row["Batch"]. "</td><td>" . $row["Section"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No student added in database!";
                        }

                        $conn->close();
                        ?> 
                    </div> 
                </div>
            </div>
        </div>
		<br>
		<a href="studentIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
		<a href="studentLogin.php" style="color: red;"><button type = "button" class = "btn btn-primary" >Logout</button></a>
    </div>
	</body>
</html>