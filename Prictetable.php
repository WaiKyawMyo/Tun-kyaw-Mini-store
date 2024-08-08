<?php  
session_start();
include('connect.php');
$post=$_SESSION['StaffPosition'];
if($post=='Staff' ){
  $staffpos='staffProduct.php';
}else{
  $staffpos='Product.php';
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
<body>
<div class="header--wrapper">

<a class="backtoProduct" href="<?php echo $staffpos ?>"><i class="fa-solid fa-arrow-left"></i> Back</a>

</div>
<div class="tabular--wrapper">
            <h3 class="main-title">
                Product Price Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT i.ItemName, i.ItemID, p.* FROM item i , price p where i.ItemID = p.ItemID";
            
            $ret=mysqli_query($connection,$select);
            $count= mysqli_num_rows($ret);

            if($count==0)
            {
                echo "<p> Price Info Not Found</p>";
            }
            ?>      
                <table>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>
                            Item Name
                        </th>
                        <th>Wholesale Price</th>
                        <th>Retail Price</th>
                        
                        <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['ItemID'];
                                    $Name= $row['ItemName'];
                                    $whprice= $row['WholesalePrice'];
                                    $reprice= $row['RetailSalePrice'];
                                    $priceID=$row['PriceID'];
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    echo "<td>$whprice</td>";
                                    echo "<td>$reprice</td>";
                                   
                                    echo "<td>
                                        <a href='PricetableEdit.php?StaffID=$priceID'>Update</a>
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