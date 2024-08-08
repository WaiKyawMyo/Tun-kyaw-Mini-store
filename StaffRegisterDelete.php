<?php  
session_start();
include('connect.php');

$StaffID=$_GET['StaffID'];

$Delete="DELETE FROM staff WHERE StaffID='$StaffID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) 
{
	echo "<script>window.alert('Successfully Deleted!');</script>";
	echo "<script>window.location='StaffRegister.php'</script>";
}
else
{
	echo "<p>Something went wrong in Staff Delete: " . mysqli_error($connection) . "</p>";
}
?>