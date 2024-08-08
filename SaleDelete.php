<?php  
session_start();
include('connect.php');

$StaffID=$_GET['StaffID'];

$Delete="DELETE FROM addtoc WHERE Number='$StaffID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) 
{
	echo "<script>window.alert('Successfully Deleted!');</script>";
	echo "<script>window.location='sale.php'</script>";
}
else
{
	echo "<p>Something went wrong in sale Delete: " . mysqli_error($connection) . "</p>";
}
?>