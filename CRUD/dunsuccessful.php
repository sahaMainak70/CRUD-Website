<html lang='en'>
    <head>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin=anonymous'>
        <link rel="stylesheet" href="alert.css">
        <title>Delete UnSuccessful</title>
    </head>
    <body>
        <?php
            session_start();
            if($_SESSION['id_exists'] == false)
            {
                echo "<div class='alert alert-danger alert-align' role='alert'> Student ID does not exists for delete</div>";
                
            }
            else
            {
                    echo "<div class='alert alert-danger alert-align' role='alert'>
                    Deletion Problem</div>";
                    $ERROR = $_SESSION['error'];
                    echo "<p>".$ERROR."</p>";
            }
                echo "<a href='crud.html'><button class='btn'>Return To Home Page</button></a>
                </div>
            </div>";
        ?>
    </body>
</html>