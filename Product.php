<?php 
session_start();
include('connect.php');

if (!isset($_SESSION['StaffName'])) {
    echo "<script>window.alert('Login Again!')</script>";
    echo "<script>window.location='StaffLogin.php'</script>";
    exit(); // Add exit to prevent further execution
}

$staffname = $_SESSION['StaffName'];

if (isset($_POST['btnregister'])) {
    $name = $_POST['txtitemname'];
    

    $itemdetail = $_POST['txtitemDetail'];
    $status = $_POST['txtstatus'];
    
   
   
    
    // File 1 upload
    $Attractionimg1 = $_FILES['txtitemIMg1']['name'];
    $folder = "Photo/";
    $finename = $folder . "_" . $Attractionimg1;
    $copy = copy($_FILES['txtitemIMg1']['tmp_name'], $finename);
    if (!$copy) {
        echo "<p>Cannot upload image 1</p>";
        exit();
    }
    
    // File 2 upload
    $Attractionimg2 = $_FILES['txtitemIMg2']['name'];
    $finename2 = $folder . "_" . $Attractionimg2;
    $copy2 = copy($_FILES['txtitemIMg2']['tmp_name'], $finename2);
    if (!$copy2) {
        echo "<p>Cannot upload image 2</p>";
        exit();
    }
    
    // Insert query
    $query = "INSERT INTO item (ItemName, ItemImage1, ItemImage2, ItemDetail, Status) 
              VALUES ('$name', '$finename', '$finename2', '$itemdetail', '$status')";
    $ret = mysqli_query($connection, $query);
    
    if ($ret) {
        $roleQuery = "SELECT * FROM item WHERE ItemName='$name'";
  $roleRet=mysqli_query($connection,$roleQuery);
  $row=mysqli_fetch_array($roleRet);

  $ID=$row['ItemID'];
        
        echo "<script>window.alert('Successfully saved!');</script>";
        echo "<script>window.location='Price.php?StaffID=$ID'</script>";
    //     $query="SELECT * FROM  item
    //     WHERE StaffEmail='$email'";
    // $ret=mysqli_query($connection,$query);
                
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
                
                <h2>Product Management</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>

        
        </div>
        <div class="header--wrapper">
        <button class="btnforadd"><a href="Brand.php">Brand Add</a></button>
        <button class="btnforadd"><a href="Prictetable.php">Price</a></button>
        </div>
        <form class="formcampsite" action="Product.php" method="POST" enctype="multipart/form-data">
         <H3>Product</H3>
        
        <label for="">Item Name</label><br>
        <input type="text" name="txtitemname" required placeholder="Name"><br>

        

        

        <label for="">Item Image 1</label><br>
        <input type="file" name="txtitemIMg1" required><br>

        <label for="">Item Image 2</label><br>
        <input type="file" name="txtitemIMg2" required><br>
       
        <label for="">Item Detail</label><br>
        <input type="text" name="txtitemDetail" required placeholder="......."><br>

        <label for="">Status</label><br>
        <input type="text" name="txtstatus" required placeholder=""><br>


      
       
    </select><br>


       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>
       
    <div class="tabular--wrapper">
            <h3 class="main-title">
                Product Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT * FROM item";
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
                        <th>Item ID</th>
                        <th>
                            Item Name
                        </th>
                        <th>Unit Item Quantity</th>
                        
                        <th> Item Image 1</th>
                        <th> Item Image 2</th>
                        <th> Item Detail</th>
                        <th> Status</th>
                        <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['ItemID'];
                                    $Name= $row['ItemName'];
                                    $unit= $row['UnitItemQuantity'];
                                    
                                    $Img1= $row['ItemImage1'];
                                    $Img2=$row['ItemImage2'];
                                    $detail=$row['ItemDetail'];
                                   
                                
                                    if($unit<1){
                                        
                                        $Update="UPDATE item 
                                        SET 
                                        Status='Unavaliable'
                                        WHERE 
                                        ItemID='$ID'
                                        ";
                               $rett=mysqli_query($connection,$Update);

                                    }
                                    else{
                                        $Update="UPDATE item 
                                        SET 
                                        Status='Avaliable'
                                        WHERE 
                                        ItemID='$ID'
                                        ";
                               $rett=mysqli_query($connection,$Update);
                                    }
                                    $status=$row['Status'];
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$unit</td>";
                                   
                                    echo "<td><img src=\"$Img1\" alt=\"\"></td>"; 
                                    echo "<td><img src=\"$Img2\" alt=\"\"></td>";
                                    echo "<td>$detail</td>";
                                    echo "<td>$status</td>";
                                    
                                    echo "<td>
                                        <a href='Productedit.php?StaffID=$ID'>Update</a>|
                                        <a href='Productdelete.php?StaffID=$ID '>Delete</a>
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