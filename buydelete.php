<?php  
session_start();
include('connect.php');

$StaffID = $_GET['StaffID'];
$post=$_SESSION['StaffPosition'];
  if($post=='Staff' ){
    $staffpos='staffbuy.php';
  }else{
    $staffpos='buy.php';
  }
$select = "SELECT p.*, i.* FROM item i, purchaseitme p WHERE i.ItemID=p.ItemID AND p.PurchaseID='$StaffID'";
$ret3 = mysqli_query($connection, $select);

if ($ret3) {
    $row = mysqli_fetch_assoc($ret3); // Fetch the row
    $num = $row['UnitItemQuantity'] - $row['UnitTotalQuantity'];
    $id = $row['ItemID'];

    $Update = "UPDATE item SET UnitItemQuantity='$num' WHERE ItemID='$id'";
    $rett = mysqli_query($connection, $Update);

    if ($rett) {
        $Delete = "DELETE FROM purchase WHERE PurchaseID='$StaffID'";
        $ret = mysqli_query($connection, $Delete);

        if ($ret) {
            $Delete2 = "DELETE FROM purchaseitme WHERE PurchaseID='$StaffID'";
            $ret2 = mysqli_query($connection, $Delete2);

            if ($ret2) {
                echo "<script>window.alert('Successfully Deleted!');</script>";
                echo "<script>window.location='$staffpos'</script>";
            } else {
                echo "<p>Something went wrong in Staff Delete: " . mysqli_error($connection) . "</p>";
            }
        } else {
            echo "<p>Something went wrong in Purchase Delete: " . mysqli_error($connection) . "</p>";
        }
    } else {
        echo "<p>Something went wrong in Item Update: " . mysqli_error($connection) . "</p>";
    }
} else {
    echo "<p>Something went wrong in Select Query: " . mysqli_error($connection) . "</p>";
}
?>