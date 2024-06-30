<?php
    require 'connection.php';
    session_start();
    if(isset($_POST['submit']))
    {
        $email = $_POST['email']; $password = $_POST['password'];
        // $query = "SELECT * FROM table1 WHERE email = '$email' ";
        // $found = $connect->query($query);
        
        //PREPARED STATEMENT
        $query="SELECT * FROM table1 WHERE email=?";
        $prepare = $connect->prepare($query);
        $prepare->bind_param('s',$email);
        $found = $prepare->execute();
        
        if($found){
            //print_r($found);
            $fetchobj=$prepare->get_result();
            // print_r($fetchobj)
            if($fetchobj->num_rows>0){
                $user=$fetchobj->fetch_assoc();
                $hashedPassword= $user['password'];
                $verify=password_verify($password, $hashedPassword);
                if($verify){
                    $_SESSION['response']="Correct Password";
                    $_SESSION['user_id']= $user['student_id'];
                    header('location:dashboard.php');    
                }
                else{
                    $_SESSION['response2']="Invalid Password";
                }
            }
            else{
                //echo 'Invalid Credentials';
                $_SESSION['response2']="Email not found";
            }
        }
        else{
            $_SESSION['response2']="Request Not Successful" ;//echo 'Request not executed';
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center text-center">
            <div class="col-6 shadow">
            <?php 
                  if (isset($_SESSION['response'])){
                        echo "<div class='alert alert-success fs-5'>" .$_SESSION['response']. "</div>";
                    }
                    unset($_SESSION['response']);
                    if (isset($_SESSION['response2'])){
                        echo "<div class='alert alert-danger fs-5'>" .$_SESSION['response2']. "</div>";
                    }
                    unset($_SESSION['response2']);
            ?>
                <p class="fs-1">Login Page</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="email" placeholder="Email" class="form-control my-2">
                    <input type="text" name="password" placeholder="Password" class="form-control my-2">
                    <input type="submit" name="submit" value="Login" class="w-100 btn btn-outline-dark">
                </form>
            </div>
        </div>
    </div>
</body>
</html>