<?php
    require 'connection.php';
    session_start();

        if(isset($_POST['submit'])){
            $firstName=$_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email =$_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
        
            $checkEmailQuery = "SELECT * FROM table1 WHERE `email`= '$email'" ;
            $found = $connect->query($checkEmailQuery); //mysqli_query($connect, $checkEmailQuery);
            
            if($found){
                if($found->num_rows>0){
                    $_SESSION['error_message'] = 'Email already exist ';
                    header('location:form.php');
                }
                else{
                     $hashedPassword = password_hash($password, PASSWORD_DEFAULT); echo $hashedPassword;
    
                    echo "<br>";
                    $query="INSERT INTO `table1`( `firstName`,`lastName`,`email`,`password`,`address` ) VALUES ( '$firstName', '$lastName', '$email', '$hashedPassword', '$address'  )" ;
                    $dbconnection = $connect->query($query);

                    if($dbconnection){
                        //echo "Registration Successful";
                        $_SESSION['response'] = 'Registration Successful '; 
                    }
                    else{
                        echo "</br>";
                        $_SESSION['error_message'] = 'Registration Failed ';
                        header('location:form.php'); 
                    }
                }
                
            }

            else{
                echo "not selected";
            }
        
    }
    
      
?>
