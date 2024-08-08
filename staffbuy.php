<?php 
session_start();
include('connect.php');

if (!isset($_SESSION['StaffName'])) {
    echo "<script>window.alert('Login Again!')</script>";
    echo "<script>window.location='StaffLogin.php'</script>";
    exit(); // Add exit to prevent further execution
}

if(isset($_POST['btnregister']))
    {
        $txtpurchasedate=$_POST['txtpurchasedate'];
        $totalamount=$_POST['txttotalamount'];
       
        $supplier=$_POST['cbosupplier'];
        $staff=$_POST['cbostaff'];

        //already exist checking
        
            $insert="INSERT INTO purchase
                     (PurchaseDate,TotalAmount,SupplierID,StaffID)
                     VALUES 
                     ('$txtpurchasedate','$totalamount','$supplier','$staff')";
                     $ret=mysqli_query($connection,$insert);
                     
        
        if($ret)
        {
            echo"<script>window.alert('Successfull saved!');</script>";
            echo"<script>window.location='staffbuy.php'</script>";
        }
        else{
            echo"<p> Something went wrong : ". mysqli_error($connection) ."</p>" ;
        }
            
    }
$staffname = $_SESSION['StaffName'];
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
                <a href="Realstaff.php" >
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
           
            <li>
                <a href="staffProduct.php">
                    <i class="fas fa-star"></i>
                    <span>Add New Product</span>
                </a>
            </li>
            <li>
                <a href="stffAddItem.php">
                <i class="fa-solid fa-plus"></i>
                    <span>Add Product</span>
                </a>
            </li>

            <li>
                <a href="staffbuy.php">
                <i class="fa-solid fa-shop"></i>
                    <span>Buy</span>
                </a>
            </li>
            <li>
                <a href="Staffsale.php">
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
                
                <h2>Purchase Management</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
       
       

        </div>
    <form class="formcampsite" action="staffbuy.php" method="POST">
         <H3>Purchase</H3>
        <label for="">Purchase Date</label><br>
        <input type="Date" name="txtpurchasedate" required placeholder="xx/xx/xxxx"><br>

        <label for="">Total Amount</label><br>
        <input type="number" name="txttotalamount" required placeholder="xxx"><br>

        

        <label for="">Supplier Name</label><br>
        <select name="cbosupplier" id="">
        <?php
            $select= "SELECT * From supplier";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SuID=$row['SupplierID'];
               $Suname= $row['SupplierName'];
               echo "<option value='$SuID'> $Suname </option>";


            }
        ?>
     </select><br>

     <label for="">Staff Name</label><br>
        <select name="cbostaff" id="">
        <?php
            $select= "SELECT * From staff";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SID=$row['StaffID'];
               $Sname= $row['StaffName'];
               echo "<option value='$SID'> $Sname </option>";


            }
        ?>
     </select><br>
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>
    <div class="tabular--wrapper">
            <h3 class="main-title">
                Purchase Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT p.*,s.* FROM purchase p,supplier s where p.SupplierID=s.SupplierID";
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
                        <th>Purchase ID</th>
                        <th>
                            Purchase Date
                        </th>
                        <th>Total Amount</th>
                        <th>Total Quantity</th>
                        <th>Supplier Name</th>
                        <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['PurchaseID'];
                                    $Name= $row['PurchaseDate'];
                                    $Email= $row['TotalAmount'];
                                    $pNO= $row['TotalQuantity'];
                                    $ADDRESS= $row['SupplierName'];

                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$Email</td>";
                                    echo "<td>$pNO</td>";
                                    echo "<td>$ADDRESS</td>";
                                    
                                    echo "<td>
                                        <a href='BuyEdit.php?StaffID=$ID'>Update</a>|
                                        <a href='buydelete.php?StaffID=$ID '>Delete</a>
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