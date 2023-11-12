<html lang='en'>
    <head>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin=anonymous'>
        <link rel="stylesheet" href="alert.css">
        <title>Registration UnSuccessful</title>
    </head>
    <body>
        <?php
            session_start();
            if($_SESSION['id_exists'] == true)
            {
                echo "<div class='alert alert-danger alert-align' role='alert'>
                Registration Unsuccessful because Student ID already exists</div>";
                $SID = $_SESSION['Sid'];
                $servername = "localhost:3307";
                $username = "root";
                $password = "";
                $dbname = "school";

                //create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                //check connection
                if(!$conn)
                    die("Unsuccessful" .mysqli_connect_error());

                //sql query
                $sql = "SELECT Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address FROM students WHERE Student_ID = $SID";
                $result = mysqli_query($conn, $sql);

                //data showing
                echo "<div class='box'>
                            <div class='Wrapper'>";
                if(mysqli_num_rows($result) > 0)
                {
                    echo "<h1>Previously Registered Data</h1>
                                <table class='content'>
                                <thead>
							        <tr>
								        <th>Student ID</th>
								        <th>Student Name</th>
								        <th>Date of Birth</th>
								        <th>Father's Name</th>
								        <th>Mother's Name</th>
                                        <th>Address</th>
							        </tr>
                                </thead>
                                <tbody>";
                    while($row = mysqli_fetch_assoc($result))
                    {
                            echo "<tr>
							        <td>".$row["Student_ID"]."</td>
							        <td>".$row["Student_Name"]."</td>
							        <td>".$row["DOB"]."</td>
							        <td>".$row["Father_Name"]."</td>
							        <td>".$row["Mother_Name"]."</td>
                                    <td>".$row["Address"]."</td>
						        </tr>";
                    }
                    echo "</tbody>
                        </table>";
                }
                else
                {
                    echo "<div class='alert alert-danger alert-align' role='alert'>
                    Registration Unsuccessful</div>";
                    $ERROR = $_SESSION['error'];
                    echo "<p>".$ERROR."</p>";
                }
                echo "<a href='crud.html'><button class='btn'>Return To Home Page</button></a>
                </div>
            </div>";
            }
        ?>
    </body>
</html>