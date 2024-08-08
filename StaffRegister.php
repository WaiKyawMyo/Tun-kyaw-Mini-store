<?php
    session_start();
    
    $staffname=$_SESSION['StaffName'];
    include('connect.php');
    if (!isset($_SESSION['StaffName']))
    {
        echo"<script>window.alert('Login Again!')</script>";
        echo"<script> window.location='StaffLogin.php'</script>";
    }
    if(isset($_POST['btnregister']))
    {
        $name=$_POST['txtstaffname'];
        $positon=$_POST['txtpositon'];
        $address=$_POST['txtaddress'];
        $phontnumber=$_POST['txtphonenumber'];
        $email=$_POST['txtemial'];
        $password=$_POST['txtpassword'];

        //already exist checking
        $query="SELECT * FROM staff 
                WHERE StaffEmail='$email'";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);

        if($count> 0)
        {
            echo"<script>window.alert('Email already exist !');</script>";
            echo"<script>window.location='StaffRegister.php'</script>";
        }
        else{
            $insert="INSERT INTO staff
                     (StaffName,StaffPosition,StaffAddress,StaffPhoneNumber,StaffEmail,StaffPassword)
                     VALUES 
                     ('$name','$positon','$address','$phontnumber','$email','$password')";
                     $ret=mysqli_query($connection,$insert);
                     
        }
        if($ret)
        {
            echo"<script>window.alert('Successfull saved!');</script>";
            echo"<script>window.location='StaffRegister.php'</script>";
        }
        else{
            echo"<p> Something went wrong : ". mysqli_error($connection) ."</p>" ;
        }
            
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>TK</title>
</head>
<body class="adminHOME">
<div class="sidebar">
        <div class="logo">
            
        </div>
        <ul class="menu">
            <li class="active">
                <a href="StaffHome.php" >
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Staff Register</span>
                </a>
            </li>
            <li>
                <a href="StaffRegister.php">
                    <i class="fas fa-user"></i>
                    <span>Staff</span>
                </a>
            </li>
            <li>
                <a href="Supplier.php">
                <i class="fa-solid fa-hotel"></i>
                    <span>Supplier</span>
                </a>
            </li>
            <li>
                <a href="Product.php">
                    <i class="fas fa-star"></i>
                    <span>Add New Product</span>
                </a>
            </li>
            <li>
                <a href="AddItem.php">
                <i class="fa-solid fa-plus"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="buy.php">
                <i class="fa-solid fa-shop"></i>
                    <span>Buy</span>
                </a>
            </li>
            <li>
                <a href="sale.php">
                <i class="fa-solid fa-cart-shopping"></i>
                    <span>Sale</span>
                </a>
            </li>
            <li class="logout">
                <a href="StaffLogin.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            
        </ul>
    </div>
    <div class="main-content">
        <div class="header--wrapper">
            <div class="header--title">
                
                <h2>Staff Register</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
       
       

        </div>
    <form class="formcampsite" action="StaffRegister.php" method="POST">
         <H3>Staff</H3>
        <label for="">Admin Name</label><br>
        <input type="text" name="txtstaffname" required placeholder="Name"><br>


        <label for="Staff Position">Staff Position</label><br>
        <select name="txtpositon" id="">
                <option value="Owner">
                Owner
                </option>
                <option value="Staff">
                Staff
                </option>
         </select> <br>
        

        <label for="">Address</label><br>
        <input type="text" name="txtaddress" required placeholder="Adress"><br>

        <label for="">Phone Number</label><br>
        <input type="text" name="txtphonenumber" required placeholder="+959xxxxx"><br>

        <label for="">Email</label><br>
        <input type="email" name="txtemial" required placeholder="...@gmail.com"><br>

        <label for="">Password</label><br>
        <input type="password" name="txtpassword" required placeholder="XXXXXXX"><br>
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>

    <div class="tabular--wrapper">
            <h3 class="main-title">
                Staff Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT * FROM staff";
            $ret=mysqli_query($connection,$select);
            $count= mysqli_num_rows($ret);

            if($count==0)
            {
                echo "<p> Admin Info Not Found</p>";
            }
            ?>      
                <table>
                    <thead>
                        <tr>
                        <th>Admin ID</th>
                        <th>
                            Admin Name
                        </th>
                        <th>Email</th>
                        <th>Phone NO</th>
                        <th> Address</th>
                        <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['StaffID'];
                                    $Name= $row['StaffName'];
                                    $Email= $row['StaffEmail'];
                                    $pNO= $row['StaffPhoneNumber'];
                                    $ADDRESS= $row['StaffAddress'];
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$Email</td>";
                                    echo "<td>$pNO</td>";
                                    echo "<td>$ADDRESS</td>";
                                    
                                    echo "<td>
                                        <a href='StaffRegisterEdit.php?StaffID=$ID'>Update</a>|
                                        <a href='StaffRegisterDelete.php?StaffID=$ID '>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                         ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    
</body>
</html>