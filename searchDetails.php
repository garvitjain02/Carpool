<?php
session_start();
$available;
$Email;
    if (isset($_POST['submit']))
    {
        $src = $_POST['source'];
        $dest = $_POST['destination'];
        $date = $_POST['date'];
        $seats = $_POST['seats'];

        $server = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect ($server, $username, $password);
        if(!$conn)
            echo "Connection to Database Failed due to " . mysqli_connect_error;

        $sql = "SELECT * FROM `carpool`.`offerrides` WHERE `Source` = '$src' AND (`Destination` = '$dest' OR `Intermediate Cities` = '%$dest%') AND `Date/Time` >= '$date' AND `Available Seats` >= $seats";

        $res = $conn->query($sql);    
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

        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            background-color: #E4F5D4;
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
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
    <br>
    <h1><u>Available Rides</u></h1>
    <table>
    <tr>
                <th>Offerer's Email</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Date/Time</th>
                <th>Luggage</th>
                <th>Car Type</th>
                <th>Amount</th>
                <th>Book</th>
            </tr>
        <?php
            if ($res->num_rows > 0){
            while ($row = $res->fetch_assoc())
            {
        ?>
        <tr>
            <td> <?php echo $row['Offer Email']; ?> </td>
            <td> <?php echo $row['Source']; ?> </td>
            <td> <?php echo $row['Destination']; ?> </td>
            <td> <?php echo $row['Date/Time']; ?> </td>
            <td> <?php echo $row['Luggage']; ?> </td>
            <td> <?php echo $row['Car Type']; ?> </td>
            <td> <?php echo $row['Amount']; ?> </td>
            <?php
                $available = $row['Available Seats'];
                $available = $available - $seats;
                $_SESSION['OEmail'] = $row['Offer Email'];
                $_SESSION['available'] = $available;
            ?>
            <td> <form action="searchUpdate.php" method="post"><button name="book" type="submit"> Book </button> </form> </td>
            
        </tr>
        <?php
            }}else {
                echo "<h1> No RIDES available for the given Parameters </h1>";
            }
            $conn->close();}
        ?>
    </table>
</body>
</html>


