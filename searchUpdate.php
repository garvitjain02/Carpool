<?php
session_start();

    if (isset($_REQUEST['book']))
    {  
        $server = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect ($server, $username, $password);
        if(!$conn)
            echo "Connection to Database Failed due to " . mysqli_connect_error;
        
        $available = $_SESSION['available'];
        $Email = $_SESSION['OEmail'];
        $email = $_SESSION['email'];

        if ($available == 0){
            $sql = "DELETE FROM `carpool`.`offerrides` WHERE `Offer Email`='$Email'";
            if ($conn->query($sql)){
                //echo "Successfully Booked Your RIde";
                header("Location: ride.html", true, 301);
                exit();
            }
        }
        else {
        $sql = "UPDATE `carpool`.`offerrides` SET `Available Seats`='$available', `Passengers`=`Passengers` + ' $email' WHERE `Offer Email`='$Email'";
        if ($conn->query($sql)){
            //echo "Successfully Booked Your RIde";
            header("Location: ride.html", true, 301);
            exit();
        }
    }
    }
?>