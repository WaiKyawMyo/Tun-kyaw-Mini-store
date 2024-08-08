<?php
  include('connect.php');
  session_start();
  $staffname=$_SESSION['StaffName'];
  
  if (!isset($_SESSION['StaffName']))
 {
     echo"<script>window.alert('Login Again!')</script>";
     echo"<script> window.location='StaffLogin.php'</script>";
 }
 if(isset($_POST['btnregister']))
    {
        $name=$_POST['txtsuppliername'];
        $email=$_POST['txtemail'];
        $address=$_POST['txtaddress'];
        $phontnumber=$_POST['txtphone'];
        $Return=$_POST['txtReturn'];
        $type=$_POST['txtSubtype'];

        //already exist checking
        $query="SELECT * FROM supplier
                WHERE SupplierEmail='$email'";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);

        if($count> 0)
        {
            echo"<script>window.alert('Email already exist !');</script>";
            echo"<script>window.location='Supplier.php'</script>";
        }
        else{
            $insert="INSERT INTO supplier
                     (SupplierName,SupplierEmail,SupplierAddress,SupplierPhoneNumber,SupplierReturn,SupplierType)
                     VALUES 
                     ('$name','$email','$address','$phontnumber','$Return','$type')";
                     $ret=mysqli_query($connection,$insert);
                     
        }
        if($ret)
        {
            echo"<script>window.alert('Successfull saved!');</script>";
            echo"<script>window.location='Supplier.php'</script>";
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
                    <span>Dashboard</span>
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
                
                <h2>Supplier Management</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
       
       

        </div>
        <form class="formcampsite" action="Supplier.php" method="POST">
         <H3>Supplier</H3>
        <label for="">Supplier Name</label><br>
        <input type="text" name="txtsuppliername" required placeholder="Name"><br>


       
        

        <label for="">Email</label><br>
        <input type="Email" name="txtemail" required placeholder="...@gamil.com"><br>

        <label for="">Address</label><br>
        <input type="text" name="txtaddress" required placeholder="Address"><br>

        <label for="">Phone Number</label><br>
        <input type="text" name="txtphone" required placeholder="959XXXXX"><br>

        <label for="Staff Position">Return</label><br>
        <select name="txtReturn" id="">
                <option value="True">
                True
                </option>
                <option value="Flase">
                False
                </option>
         </select> <br>

         <label for="Staff Position">Supplier Type</label><br>
        <select name="txtSubtype" id="">
                <option value="Company">
                Company
                </option>
                <option value="Whole sale">
                Whole Sale
                </option>
         </select> <br>

        
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>

    <div class="tabular--wrapper">
            <h3 class="main-title">
                Supplier Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT * FROM supplier";
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
                        <th>Supplier ID</th>
                        <th>
                            Supplier Name
                        </th>
                        <th>Email</th>
                        <th>Phone NO</th>
                        <th> Address</th>
                        <th> Return</th>
                        <th> Type</th>
                        <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['SupplierID'];
                                    $Name= $row['SupplierName'];
                                    $Email= $row['SupplierEmail'];
                                    $pNO= $row['SupplierPhoneNumber'];
                                    $ADDRESS= $row['SupplierAddress'];
                                    $Return=$row['SupplierReturn'];
                                    $type=$row['SupplierType'];
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$Email</td>";
                                    echo "<td>$pNO</td>";
                                    echo "<td>$ADDRESS</td>";
                                    echo "<td>$Return</td>";
                                    echo "<td>$type</td>";
                                    
                                    echo "<td>
                                        <a href='Supplieredit.php?StaffID=$ID'>Update</a>|
                                        <a href='SupplierDelete.php?StaffID=$ID '>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                         ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>