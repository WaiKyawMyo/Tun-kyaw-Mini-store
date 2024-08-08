<?php
    include('connect.php');
    session_start();
    $staffname=$_SESSION['StaffName'];
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
                
                <h2>Dashboard</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
       
       

        </div>
           
<div class="tabular--wrapper">
            <h3 class="main-title">
                Product Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT  i.*, pc.* 
            FROM item i 
            JOIN price pc ON i.ItemID = pc.ItemID";
            $ret=mysqli_query($connection,$select);
            $count= mysqli_num_rows($ret);

            if($count==0)
            {
                echo "<p> Item Info Not Found</p>";
            }
            ?>      
                <table>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>
                            Item Name
                        </th>
                        
                        <th>Quantity</th>
                        <th>Wholesale Price</th>
                        <th>RetailSale Price</th>
                        <th> Status</th>
                        
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['ItemID'];
                                    $Name= $row['ItemName'];
                                    
                                    $UnitItemQuantity= $row['UnitItemQuantity'];
                                    $ADDRESS= $row['WholesalePrice'];
                                    $RetailSalePrice= $row['RetailSalePrice'];
                                    $Status= $row['Status'];
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    
                                    echo "<td>$UnitItemQuantity</td>";
                                    echo "<td>$ADDRESS</td>";
                                    echo "<td>$RetailSalePrice</td>";
                                    echo "<td>$Status</td>";
                                    echo "</tr>";
                                }
                         ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main-title">
                Low Item
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT  i.*,ps.*
            FROM item i,purchaseitme ps
             where UnitItemQuantity < 5";
            $ret=mysqli_query($connection,$select);
            $count= mysqli_num_rows($ret);
           
        
            if($count==0)
            {
                echo "<p> Item Info Not Found</p>";
            }
            ?>      
                <table>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>
                            Item Name
                        </th>
                        <th>Exp Date</th>
                        <th>Quantity</th>
                        
                        <th> Status</th>
                        
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['ItemID'];
                                    $Name= $row['ItemName'];
                                    $Exp=$row['ExpDate'];
                                    $UnitItemQuantity= $row['UnitItemQuantity'];
                                   
                                    $Status= $row['Status'];
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$Exp</td>";
                                    echo "<td> $UnitItemQuantity</td>";
                                    
                                    echo "<td>$Status</td>";
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