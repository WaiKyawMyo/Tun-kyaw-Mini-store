<?php
 include('connect.php');
 session_start();
 $staffname=$_SESSION['StaffName'];
 $post=$_SESSION['StaffPosition'];
 if($post=='Staff' ){
   $staffpos='staffProduct.php';
 }else{
   $staffpos='Product.php';
 }
 if (!isset($_SESSION['StaffName']))
{
    echo"<script>window.alert('Login Again!')</script>";
    echo"<script> window.location='StaffLogin.php'</script>";
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
                
                <h2>Sale</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
       
       

        </div>


        <div class="header--wrapper">
        <button class="btnforadd"><a href="Trysale.php">Wholesale</a></button>
        <button class="btnforadd"><a href="Retailsale.php">RetailSale</a></button>
        </div>

<div class="tabular--wrapper">
            <h3 class="main-title">
                Sale info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT c.*, s.* 
            FROM sale s
            JOIN customer c ON c.CustomerID = s.CustomerID";
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
                        <th>Sale ID</th>
                        <th>
                            Sale Date
                        </th>
                        
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Customer Name</th>
                        
                        
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['SaleID'];
                                    $Name= $row['SaleID'];
                                    
                                    $UnitItemQuantity= $row['SaleQuantity'];
                                    $ADDRESS= $row['SaleTotalPrice'];
                                    $RetailSalePrice= $row['CustomerName'];
                                    
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    
                                    echo "<td>$UnitItemQuantity</td>";
                                    echo "<td>$ADDRESS</td>";
                                    echo "<td>$RetailSalePrice</td>";
                                  
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
