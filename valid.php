<?php
    session_start();

    if (isset($_POST['submit']))
    {
        $server = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect ($server, $username, $password);
        if (!$conn)
            die ("Connection to Database Failed due to " . mysqli_connect_error);
        
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $_SESSION['email'] = $email;
        $sql = "INSERT INTO `carpool`.`userdetails` (`Name`, `Email`, `Phone`, `DOB`, `Gender`, `Password`) VALUES ('$name', '$email', '$phone', '$dob', '$gender', '$pass')";

        if ($conn->query($sql) == true)
        {
            header("Location: ride.html", true, 301);
        exit();
        }
        
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
            padding-top: 3%;
            padding-bottom: 3%;
            margin: auto;
            margin-top: 2%;
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

    <script>
        function validation()
        {
            var name = document.forms["SignUp"]["name"];
            var email = document.forms["SignUp"]["email"];
            var phone = document.forms["SignUp"]["phone"];
            var pass = document.forms["SignUp"]["pass"];
            var repass = document.forms["SignUp"]["repass"];

            if (name.value == "")
            {
                window.alert("Please Enter Name");
                name.focus();
                return false;
            }
            if (email.value == "")
            {
                window.alert("Please Enter Email");
                email.focus();
                return false;
            }
            if (phone.value == "")
            {
                window.alert("Please Enter Phone Number");
                phone.focus();
                return false;
            }
            // if (pass != repass)
            // {
            //     window.alert("Re-Entered Password Do Not Match");
            //     repass.focus();
            //     return false;
            // }
        }
    </script>
</head>
<body><div class="header">
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="SignUp" onsubmit="validation()">
    <p style="font-size:30px; margin-top: 0%; margin-bottom: 0%;">Sign Up</p><p></p>
        <input type="text" name="name" placeholder="Enter Name" pattern="[a-z A-Z]{3,30}"> <br><br>
        <input type="text" name="email" placeholder="Enter Email ID" pattern="[a-z A-Z 0-9 _\-\.]+@+[A-Za-z0-9_\-\.]+[\.]+[a-z+]{2,5}"> <br><br>
        <input type="text" name="phone" placeholder="Enter Phone Number" pattern="[0-9]{10}"> <br><br>
        <input type="date" name="dob" placeholder="Enter DOB"> <br><br>
        Male <input type="radio" name="gender" value="M">
        Female <input type="radio" name="gender" value="F">
        Others <input type="radio" name="gender" value="O"> <br><br>
        <input type="text" name="pass" placeholder="Enter Password"><br><br>
        <input type="password" name="repass" placeholder="Re-Enter the Password"><br><br>
        <input type="submit" name="submit">
        <script>
            var pass = document.forms["SignUp"]["pass"];
            var repass = document.forms["SignUp"]["repass"];
            // if (pass != repass)
            // {
            //     window.alert("Re-Entered Password Do Not Match");
            //     repass.focus();
            //     return false;
            // }
        </script>
    </form>
    </div>
</body>
</html>