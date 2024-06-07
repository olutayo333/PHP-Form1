<?php
    $host = 'localhost';
    $username= 'root';
    $password = '';
    $db='student_table';

   // CONNECTING USING OOP
    $connect=new mysqli($host, $username, $password, $db);
    
    if($connect){
        echo' ';
    }
    else{
        echo 'connected'.$connect->connect_error;

    }

    // CONNECTION USING PROCEDURER
//     $connect = mysqli_connect($host, $username, $password, $db);
//     if($connect){
//         echo " connected";
//     }
//     else {
//        echo 'not connected'; echo'<br/>';
//        //echo(mysqli_connect_error());
//    }


?>