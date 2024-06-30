<?php
    require 'connection.php';
    session_start();
    //print_r($_SESSION['user_id']);
    $id=$_SESSION['user_id'];
    echo $id;

    $query = "SELECT * FROM table1 WHERE student_id =$id" ;
    $con = $connect->query($query);
    $user = $con->fetch_assoc();
    //print_r($user);
    $firstname = $user['firstName']; $lastname = $user['lastName']; $profile_pics=$user['profile_pics'];
    print_r($profile_pics);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center text-center"> 
            <!-- "uploads/".$unique_name -->
            <div class="col-6">
               
                <img src="<?php echo 'uploads/'.$profile_pics; ?>" alt=""; style="width: 100px; height: 100px; border-radius:100%">
                <h3> Welcome to your dashboard <?php  echo $firstname. " ". $lastname ?> </h3>
                
                <form action="profilepics_processing.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <input type="submit" name="submit" value="submit" class="btn btn-dark">
                </form>
                
            </div>
        </div>

    </div>
</body>
</html>