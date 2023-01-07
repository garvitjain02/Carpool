<?php
session_start();
$valid = true;
if (isset($_POST['submit']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect ($server, $username, $password);
        if(!$conn)
            echo "Connection to Database Failed due to " . mysqli_connect_error;

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT `Password` FROM `carpool`.`userdetails` WHERE `Email` LIKE '$email'";
        
        $_SESSION['email'] = $email;
        $res = $conn->query($sql);


        if ($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $p = $row['Password'];
            if ($p == $pass){
                header("Location: ride.html", true, 301);
                exit();
            }
            else{
                $valid = false;
            }
        }
        else
            $valid = false;

        $conn->close();
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        .vl{
            display: inline-block;
                border-left: 2px solid black;
                height: 10px;
                position: relative;
                margin-top: 2%;
            }
        
        .container
        {
            border: solid black 1px;
            width: 17%;
            padding-left: 4%;
            padding-top: 3%;
            padding-bottom: 3%;
            margin: auto;
            margin-top: 9%;
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
    <button class="bt"> Sign IN</button></a>
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
        <form name="SignIn" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="ride.html">
            <p style="font-size:30px; margin-top: 0%; margin-bottom: 0%;">Sign In</p>
            <p style="color:red"><?php 
            if ($valid == false)
                echo "*Incorrect Credentials ";
            ?></p>
            <input type="email" name="email" placeholder="Enter Email ID" pattern="[a-z A-Z 0-9 _ \-\.]+@+[A-Za-z0-9_\-\.]+[\.]+[a-z+]{2,5}"> <br><br>
            <input type="password" name="pass" placeholder="Enter Password"> <br><br>
            <a href="C:\xampp\htdocs\Carpool\ride.html">
            <input type="submit" name="submit">
            </a>
        </form>
    </div>
</body>
</html>
