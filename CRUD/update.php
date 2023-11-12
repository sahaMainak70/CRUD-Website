<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update</title>
</head>
<body>
    <div class="container">
        <h1>Update</h1>
        <nav class="navbar">
            <ul>
                <li>
                    <form action="update.php" method="post">
                        <div class="input">
                            <label for="update">Update by Student ID: </label>
                            <input type="text" name="update" placeholder="Enter student ID"></input>
                            <button type="submit" name="search"> <svg class="svg-icon search-icon" aria-labelledby="title desc" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7"><title id="title">Search Icon</title><desc id="desc">A magnifying glass icon.</desc><g class="search-path" fill="none" stroke="#848F91"><path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4"/><circle cx="8" cy="8" r="7"/></g></svg></button>
                        </div>
                    </form>
                </li>
            </ul>
        </nav>
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
            if(isset($_POST['search']))
            {
                $SID = $_POST['update'];
                $id_exists = false;
                $sqlsearch = "SELECT Student_ID FROM students WHERE Student_ID = $SID";
                $result = mysqli_query($conn, $sqlsearch);
                if(mysqli_num_rows($result) > 0)
                {
                    $id_exists = true;
                    $sql = "SELECT Student_Name, DOB, Father_Name, Mother_Name, Address FROM students WHERE Student_ID = $SID";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $SNAME = $row["Student_Name"];
                    $DOB = $row["DOB"];
                    $FNAME = $row["Father_Name"];
                    $MNAME = $row["Mother_Name"];
                    $ADDRESS = $row["Address"];
                    echo "<h1>Update Form</h1>
                <form action='update.php' method='post'>
                    <div class='input-box'>
                        <h3>*Student ID: <input type='text' name='sid' placeholder='Enter Your ID' value='$SID' required></input></h3>
                    </div>
                    <div class='input-box'>
                        <h3>*Student Name: <input type='text' name='sname' placeholder='Enter Your Name' value='$SNAME' required></input></h3>
                    </div>
                    <div class='input-box'>    
                        <h3>*Date Of Birth: <input type='date' name='dob' placeholder='Enter Your DOB' value='$DOB' required></input></h3>
                    </div>
                    <div class='input-box'>
                        <h3>*Father's Name: <input type='text' name='fname' placeholder='Enter Your Father's Name' value='$FNAME' required></input></h3>
                    </div>
                    <div class='input-box'>
                        <h3>*Mother's Name: <input type='text' name='mname' placeholder='Enter Your Mother's Name' value='$MNAME' required></input></h3>
                    </div>
                    <div class='input-box'>
                        <h3>*Address: <input type='text' name='address' placeholder='Enter Your Address' value='$ADDRESS' required></input></h3>
                    </div>
                    <button type='submit' name='submit'class='btn'>Update</button>
                </form>";
                }
                else
                {
                    session_start();
                    $id_exists = false;
                    $_SESSION['id_exists'] = $id_exists;
                    header("Location: uunsuccessful.php");
                    die();
                }
            }
            mysqli_close($conn);
        ?>
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
                $SNAME = $_POST["sname"];
                $DOB = date('Y-m-d', strtotime($_POST["dob"]));
                $FNAME = $_POST["fname"];
                $MNAME = $_POST["mname"];
                $ADDRESS = $_POST["address"];

                //sql query
                $sqlquery = "UPDATE `students` SET `Student_ID` = '$SID', `Student_Name` = '$SNAME', `DOB` = '$DOB', `Father_Name` = '$FNAME', `Mother_Name` = '$MNAME', `Address` = '$ADDRESS' WHERE `students`.`Student_ID` = $SID";

                //data insertion
                if(mysqli_query($conn, $sqlquery))
                {
                    session_start();
                    $_SESSION['Sid'] = $SID;
                    header("Location: usuccessful.php");
                    die();
                }
                else
                {
                    $ERROR = mysqli_error($conn);
                    session_start();
                    $_SESSION['error'] = $ERROR;
                    header("Location: uunsuccessful.php");
                    die();
                }

                mysqli_close($conn);
            }
        ?>
<br>
<a href="crud.html"><button type="submit" name="return" class="btn" >Return To Home Page</button></a>
    </div>
</body>
</html>