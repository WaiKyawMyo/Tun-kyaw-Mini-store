<?php  
session_start();
include('connect.php');

$StaffID=$_GET['StaffID'];

$Delete="DELETE FROM supplier WHERE SupplierID='$StaffID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) 
{
	echo "<script>window.alert('Successfully Deleted!');</script>";
	echo "<script>window.location='Supplier.php'</script>";
}
else
{
	echo "<p>Something went wrong in Staff Delete: " . mysqli_error($connection) . "</p>";
}
?>