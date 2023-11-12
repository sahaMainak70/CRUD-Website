<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Create</title>
</head>
<body>
    <!-- Form Creation -->
    <div class="container">
        <h1>Registration Form</h1>
        <form action="create.php" method="post">
            <div class="input-box">
                <h3>*Student ID: <input type="text" name="sid" placeholder="Enter Your ID" required></input></h3>
            </div>
            <div class="input-box">
                <h3>*Student Name: <input type="text" name="sname" placeholder="Enter Your Name" required></input></h3>
            </div>
            <div class="input-box">    
                <h3>*Date Of Birth: <input type="date" name="dob" placeholder="Enter Your DOB" required></input></h3>
            </div>
            <div class="input-box">
                <h3>*Father's Name: <input type="text" name="fname" placeholder="Enter Your Father's Name" required></input></h3>
            </div>
            <div class="input-box">
                <h3>*Mother's Name: <input type="text" name="mname" placeholder="Enter Your Mother's Name" required></input></h3>
            </div>
            <div class="input-box">
                <h3>*Address: <input type="text" name="address" placeholder="Enter Your Address" required></input></h3>
            </div>
            <button type="submit" name="submit" class="btn">Submit</button>
        </form>
    </div>

    <?php
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "school";

        //create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        //check connection
        if(!$conn)
            die("Unsuccessful" .mysqli_connect_error());
        if(isset($_POST["submit"]))
        {
            
            
            //data fetching
            $SID = $_POST["sid"];
            $id_exists = false;
            $sqlsearch = "SELECT Student_ID FROM students WHERE Student_ID = $SID";
            $result = mysqli_query($conn, $sqlsearch);
            if(mysqli_num_rows($result) > 0)
            {  
                session_start();
                $id_exists = true;
                $_SESSION['id_exists'] = $id_exists;
                $_SESSION['Sid'] = $SID;
                header("Location: cunsuccessful.php");
                die();
            }
            else
            {
                $SNAME = $_POST["sname"];
                $DOB = date('Y-m-d', strtotime($_POST["dob"]));
                $FNAME = $_POST["fname"];
                $MNAME = $_POST["mname"];
                $ADDRESS = $_POST["address"];

                //sql query
                $sql = "INSERT INTO students(Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address) VALUES('$SID', '$SNAME', '$DOB', '$FNAME', '$MNAME', '$ADDRESS')";

                //data insertion
                if(mysqli_query($conn, $sql))
                {
                    session_start();
                    $_SESSION['Sid'] = $SID;
                    header("Location: csuccessful.php");
                    die();
                }
                else
                {
                    $ERROR = mysqli_error($conn);
                    session_start();
                    $_SESSION['error'] = $ERROR;
                    header("Location: cunsuccessful.php");
                    die();
                }

                mysqli_close($conn);
            }
         }
    ?>
</body>
</html>