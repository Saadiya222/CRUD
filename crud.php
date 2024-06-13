<?php
session_start();
include 'database.php';
if(isset($_POST["submit"])){

    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];

    $sql= "SELECT email FROM user WHERE email='$email'";
    $sqlres=mysqli_query($connect,$sql);
    $sqlnum=mysqli_num_rows($sqlres);

    if($sqlres && $sqlnum==0){
        $sql="INSERT INTO user (FirstName,LastName,email) VALUES ('$fname','$lname','$email')";
        $sqlres=mysqli_query($connect,$sql);
    }

    $_SESSION["FirstName"]=$fname;
    $_SESSION["LastName"]=$lname;
    $ID="SELECT ID FROM user WHERE email='$email'";
    $_SESSION["ID"]=mysqli_fetch_assoc(mysqli_query($connect,$ID))['ID'];

    header("Location: notes.php");

    exit();

}



?>

<!DOCTYPE html>

<html>
    <head>
        <title>
            NOTES | INFO
        </title>
        <link href="notes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form class="form" method="post">
            <h1 style="text-align:center; color:cadetblue; font-size:50px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
 ">INFO</h1>
        <label class="info"> First Name <br>
        <input type="text" class="input" name="fname">
        </label>
        <br>
        <label class="info"> Last Name <br>
        <input type="text" class="input" name="lname">
        </label>
        <br>
        <label class="info"> Email <br>
        <input type="text" class="input" name="email">
        </label>
        <input type="reset" value="cancel" class="cancel" name="cancel" >
        <input type="submit" value="submit" class="submit" name="submit">
        </form>
        

        
    </body>
</html>