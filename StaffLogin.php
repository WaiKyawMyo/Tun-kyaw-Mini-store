<?php
session_start();
include('connect.php');
if(isset($_POST['Btnlogin']))
{
    $txtemail=$_POST['txtemail'];
    $txtpassword=$_POST['txtpassword'];
    $txtpos=$_POST['cbobrand'];
    
    $query = "SELECT * FROM staff WHERE StaffEmail='$txtemail' AND StaffPassword='$txtpassword' AND StaffPosition='$txtpos'";

$ret=mysqli_query($connection,$query);
$count=mysqli_num_rows($ret);
$row= mysqli_fetch_array($ret);
if($count < 1)
{
echo"<script>window.alert('Email or Password incorrct!');</script>";
echo"<script>window.location='StaffLogin.php'</script>";}
else{
         if($txtpos=='Staff'){
    $_SESSION['StaffName']=$row['StaffName'];
    $_SESSION['StaffID']=$row['StaffID'];
    $_SESSION['StaffPosition']=$row['StaffPosition'];
    echo"<script>window.alert('Login Successfull');</script>";
    echo"<script>window.location='Realstaff.php'</script>";
    }   else{
        $_SESSION['StaffName']=$row['StaffName'];   
        $_SESSION['StaffID']=$row['StaffID'];
        $_SESSION['StaffPosition']=$row['StaffPosition'];
        echo"<script>window.alert('Login Successfull');</script>";
        echo"<script>window.location='StaffHome.php'</script>";
    
    }
}
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="Loginad">
    


    
    <div class="background1">
    
    <form  action="StaffLogin.php" method="POST">   
        <div class="container">
            <div class="card">
                <h1 class="">TKMS</h1>
                <a class="login">Log in</a>
                <div class="inputBox">
                    <input type="email" required="required" name="txtemail">
                    <span class="user">Email</span>
                </div>

                <div class="inputBox">
                    <input type="password" required="required" name="txtpassword">
                    <span>Password</span>
                </div>
                <label for="">Staff Positon</label>
        
     </select>
     <Select name="cbobrand">
        <option value="Staff">Staff</option>
        <option value="Owner">Owner</option>
     </Select>

                <button class="enter" name="Btnlogin">Enter</button>
               
            </div>
            
        </div>

        
    </form> 
  

    </div>
   
</html>