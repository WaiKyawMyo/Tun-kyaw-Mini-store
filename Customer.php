<?php
 include('connect.php');
 session_start();
 $staffname=$_SESSION['StaffName'];
 $post=$_SESSION['StaffPosition'];
 $StID=$_SESSION['StaffID'];
 $Quantity=$_SESSION['Quantity'];
 $toaalam=$_SESSION['totalforall'];
 $_SESSION['cusdetail']=$_SESSION['Dataall'];
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
if (isset($_POST['btnregister'])) {
    $name = mysqli_real_escape_string($connection, $_POST['txtname']);
    $gender = mysqli_real_escape_string($connection, $_POST['txtgenter']);
    $age = (int)$_POST['txtage'];
    $payment = (float)$_POST['txtpayme'];
    $debt = $toaalam - $payment;
    $date = $_POST['dateforp'];

    // Insert customer
    $insertCustomer = "INSERT INTO customer (CustomerName, Gender, Age, Debt) VALUES ('$name', '$gender', '$age', '$debt')";
    $ret = mysqli_query($connection, $insertCustomer);
    if ($ret) {
        $selectCustomer = "SELECT CustomerID FROM customer ORDER BY CustomerID DESC LIMIT 1";
        $result = mysqli_query($connection, $selectCustomer);
        $row = mysqli_fetch_assoc($result);
        $Cusid = $row['CustomerID'];

        // Insert sale
        $insertSale = "INSERT INTO sale (SaleDate, SaleQuantity, SaleTotalPrice, CustomerID, StaffID) VALUES ('$date', '$Quantity', '$toaalam', '$Cusid', '$StID')";
        $ret3 = mysqli_query($connection, $insertSale);
        if ($ret3) {
            $selectSale = "SELECT SaleID FROM sale ORDER BY SaleID DESC LIMIT 1";
            $result2 = mysqli_query($connection, $selectSale);
            $row2 = mysqli_fetch_assoc($result2);
            $saleid = $row2['SaleID'];

            if (!empty($_SESSION['cusdetail'])) {
                foreach ($_SESSION['cusdetail'] as $key => $value) {
                    $itemID = $value['id'];
                    $unitprice = $value['price'];
                    $unitquant = $value['quantity'];
                   $Saleddd =$saleid;
                    $insertItemSale = "INSERT INTO itemsale (ItemID, SaleID, UnitSalePrice, UnitSaleQuanitity) VALUES ('$itemID', '$Saleddd', '$unitprice', '$unitquant')";
                    $ret4 = mysqli_query($connection, $insertItemSale);

                    if (!$ret4) {
                        echo "<script>alert('Failed to register item sale.');</script>";
                    }
                }
                echo "<script>alert('Successfully Sale!'); window.location='$staffpos';</script>";
            }
        } else {
            echo "<script>alert('Failed to register sale.');</script>";
        }
    } else {
        echo "<script>alert('Failed to register customer.');</script>";
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
<body>
<form class="formcampsite" action="Customer.php" method="POST">
         <H3>Customer</H3>
        <label for="">Customer Name</label><br>
        <input type="text" name="txtname" required placeholder="Name"><br>


        <label for="Staff Position">Customer Gender</label><br>
        <select name="txtgenter" id="">
                <option value="Male">
                Male
                </option>
                <option value="Female">
                Female
                </option>
         </select> <br>
        

        <label for="">Age</label><br>
        <input type="Number" name="txtage" required placeholder="123"><br>

        <label for="">Customer Payment</label><br>
        <input type="number" name="txtpayme" required placeholder="XXXXX"><br>

        <label for="">Sale date</label><br>
        <input type="Date" name="dateforp" required placeholder="XXXXX"><br>
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>

</body>
</html>