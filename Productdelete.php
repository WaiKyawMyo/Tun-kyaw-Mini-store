<?php  
session_start();
include('connect.php');

$StaffID=$_GET['StaffID'];
$post=$_SESSION['StaffPosition'];
  if($post=='Staff' ){
    $staffpos='staffProduct.php';
  }else{
    $staffpos='Product.php';
  }
$Delete="DELETE FROM itembrand WHERE ItemID='$StaffID' ";
$ret=mysqli_query($connection,$Delete);
$Delete="DELETE FROM price WHERE ItemID='$StaffID' ";
$ret2=mysqli_query($connection,$Delete);
$Delete="DELETE FROM purchaseitme WHERE ItemID='$StaffID' ";
$ret4=mysqli_query($connection,$Delete);

$Delete="DELETE FROM item WHERE ItemID='$StaffID' ";
$ret3=mysqli_query($connection,$Delete);





if($ret3) 
{
	echo "<script>window.alert('Successfully Deleted!');</script>";
	echo "<script>window.location='$staffpos'</script>";
}
else
{
	echo "<p>Something went wrong in Staff Delete: " . mysqli_error($connection) . "</p>";
}
?>