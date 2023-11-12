<?php
    if(!empty($_POST['rows']))
        $rows = $_POST['rows'];
        
?>
<?php
    if(!empty($_POST['sort']))
        $sort = $_POST['sort'];
        
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Read</title>
</head>
<body>

    <!-- page creation -->
    <div class="container">
        <h1>Read</h1>
        <nav class="navbar">
            <ul>
                <li><form action="" method="post">
                        <input type="checkbox" name="show" value="show">Show All</input>
                    </form>
                </li>
                <li>
                    <form action="read.php" method="post">
                        <div class="select">
                        <label for="rows">Number of Rows: </label>
                        <select name="rows" id="rows" onchange="this.form.submit();">
                            <option value="25" <?php if(isset($rows) && $rows=="25") echo "selected";?>>25</option>
                            <option value="50" <?php if(isset($rows) && $rows=="50") echo "selected";?>>50</option>
                            <option value="100" <?php if(isset($rows) && $rows=="100") echo "selected";?>>100</option>
                            <option value="250" <?php if(isset($rows) && $rows=="250") echo "selected";?>>250</option>
                            <option value="500" <?php if(isset($rows) && $rows=="500") echo "selected";?>>500</option>
                        </select>
                        </div>
                    </form>        
                </li>
                <li>
                    <form action="read.php" method="post">
                        <div class="input">
                            <label for="filter">Filter rows: </label>
                            <input type="text" name="filter" placeholder="Search by student ID"></input>
                            <button type="submit" name="submit"> <svg class="svg-icon search-icon" aria-labelledby="title desc" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7"><title id="title">Search Icon</title><desc id="desc">A magnifying glass icon.</desc><g class="search-path" fill="none" stroke="#848F91"><path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4"/><circle cx="8" cy="8" r="7"/></g></svg></button>
                        </div>
                    </form>
                </li>
                <li>
                    <form action="read.php" method="post">
                        <div class="select">
                        <label for="sort">Sort by Key: </label>
                        <select name="sort" id="sort" onchange="this.form.submit();">
                            <option value="none" <?php if(isset($sort) && $sort=="none") echo "selected";?>>none</option>
                            <option value="asc" <?php if(isset($sort) && $sort=="asc") echo "selected";?>>Student ID(ASC)</option>
                            <option value="desc" <?php if(isset($sort) && $sort=="desc") echo "selected";?>>Student ID(DESC)</option>
                        </select>
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
            if(!empty($_POST['rows']))
            {
                $sql = "SELECT Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address FROM students";
            $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
                    $value = 0;
                    
                    if($value < $rows)
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
                    else
                    {
                        break;
                    }
                }
                echo "</tbody>
                    </table>";
                    
                }
            }
            elseif(isset($_POST['submit']))
            {
                $filter = $_POST['filter'];
                    $sql = "SELECT Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address FROM students WHERE Student_ID = $filter";
                    $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
                
            }
            elseif(!empty($_POST['sort']))
            {
                if($sort == 'asc')
                {
                    $sql = "SELECT * FROM `students` ORDER BY `Student_ID` ASC";
                    $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
                }
                elseif($sort == 'desc')
                {
                    $sql = "SELECT * FROM `students` ORDER BY `Student_ID` DESC";
                    $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
                }
                else
                {
                    $sql = "SELECT Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address FROM students";
            $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
                }
            }
            else
            {
                $sql = "SELECT Student_ID, Student_Name, DOB, Father_Name, Mother_Name, Address FROM students";
            $result = mysqli_query($conn, $sql);

            //data showing
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='content-table'>
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
            }
            
            mysqli_close($conn);
        ?>
            <a href="crud.html"><button type="submit" name="return" class="btn" >Return To Home Page</button></a>
    </div>
    
</body>
</html>