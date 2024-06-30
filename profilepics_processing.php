<?php
    require 'connection.php';
    session_start();
    //print_r($_SESSION['user_id']);


    if (isset($_POST['submit'])){
        print_r($_FILES); echo '</br>';
        
        $name= $_FILES['image']['name'];
        $temp_location = $_FILES['image']['tmp_name'];

        $unique_name= time().' '.$name; // Making the name unique
        print_r("name= ". $name. " ". "unique name = ". $unique_name. " ". "Temporary location = ".  $temp_location);
        
        //moving the images to a folder
        $move = move_uploaded_file($temp_location, "uploads/".$unique_name);
        if ($move){
            $id = $_SESSION['user_id'];
            $query = "UPDATE table1 SET profile_pics='$unique_name' WHERE student_id = $id" ;
            $dbcon = $connect->query($query);
            echo " Moved succesfully";
            header('location:dashboard.php');
        }
        else{
            echo "File upload fails";
        }


    }
?>