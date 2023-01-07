<?php
session_start();

if (isset($_POST['submit'])){
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect ($server, $username, $password);
    if(!$conn)
        echo "Connection to Database Failed due to " . mysqli_connect_error;
    
    $src = $_POST['source'];
    $dest = $_POST['destination'];
    $intermediate = $_POST['intermediate'];
    $date = $_POST['date'];
    $seats = $_POST['seats'];
    $luggage = $_POST['Luggage'];
    $type = $_POST['carType'];
    $amt = $_POST['amount'];
    $email = $_SESSION['email'];

    // $sql = "UPDATE `carpool`.`offerrides` SET 'Source' = '$src', 'Destination' = '$dest', 'Date/Time' = '$date', 'Luggage' = '$luggage', 'Number of Passengers' = '$seats', 'Amount' = '$amt', 'Car Type' = '$type', 'Available Seats' = '$seats' WHERE 'Offer Email' = NOT NULL AND 'Number of Passengers' = NULL";
    $sql = "INSERT INTO `carpool`.`offerrides` (`Source`, `Destination`, `Date/Time`, `Luggage`, `Number of Passengers`, `Amount`, `Car Type`, `Available Seats`, `Offer Email`, `Intermediate Cities`) VALUES ('$src', '$dest', '$date', '$luggage', '$seats', '$amt', '$type', '$seats', '$email', '$intermediate')";

    if ($conn->query($sql))
    {
        header("Location: ride.html", true, 301);
        exit();
    }
    // else
    //      echo "ERROR: $sql <br> $conn->error";

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .button
        {
            margin: 10px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 7px;
            padding-top: 7px;
            border-radius: 10%;
            background: cornflowerblue;
            color: white;
            font-size: 110%;
            cursor: pointer;
            width: 40%;
            height: 55px;
            font-size: 27px;
        }

        .container
        {
            border: solid black 1px;
            width: 17%;
            padding-left: 4%;
            padding-top: 2%;
            padding-bottom: 2%;
            margin: auto;
            margin-top: 1%;
            background-color: rgba(255,225,255,.5);
        }

        .header {
            background-color: #2954e2;
            padding: 7px;
            height: 143px;
        }
          
        .header-left {
            float: left;
            width: 20%;
            margin: 1px;
          }
          
          .header-right {
            float: right;
            width: 15%;
            margin: 1px;
          }
          
          .header-center {
            float: left;
            width: 62%;
          }
          
          
        body{
            margin: 0;
        }

        .bt
        {
            cursor: pointer;
            float: right;
            margin-right: 43px;
            background-color: white;
            text-decoration: none;
            font-size: 20px;
            margin-top: 6px;
            border: 2px solid orange;
            padding: 4px 1pz;
        }

        hr{
            padding: 4px;
            margin: 0%;
            background: chocolate;
        }
    </style>

    
</head>
<body>
<div class="header">
        <div class="header-left">
        <img src="1.png" style="height: 140px; padding: 0px; margin: 0px;">
    </div>
    <div class="header-center">
        <img src="name-removebg-preview.png" style="
        height: 140px;
        width: 53%;
        margin-left: 190px;
    "></div>
    <div class="header-right">
    <a href="login.html">
        <img src="face-removebg-preview.png" style="
        height: 100px;
        /* text-align: right; */
        float: right;
    ">
    <button class="bt"> Logout</button></a>
</div>
</div>
<div style="
background-image: url('bg.jpg');
background-repeat: no-repeat;
background-attachment: fixed;  
  background-size: cover;
  height:500px;">
    <hr>
<div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p style="font-size:30px; margin-top: 0%; margin-bottom: 0%;">Offer Ride</p><p></p>
            <input type="text" name="source" placeholder="Enter Source Location"> <br><br>
            <input type="text" name="destination" placeholder="Enter Destination Location"> <br><br>
            <input type="text" name="intermediate" placeholder="Enter Intermediate Cities"> <br><br>
            <input type="datetime" name="date" placeholder="yyyy-mm-dd hh:mm:ss"> <br><br>
            <input type="number" name="seats" placeholder="Enter Number of Seats"> <br><br>
            Luggage: <br>
            S <input type="radio" name="Luggage" value="S">
            M <input type="radio" name="Luggage" value="M">
            L <input type="radio" name="Luggage" value="L"> <br><br>
            <input type="text" name="carType" placeholder="Enter Type of Car"><br><br>
            <input type="number" name="amount" placeholder="Enter Amount"> <br><br> 
            <input type="submit" name="submit">
        </form>
    </div>
</body>
</html>

