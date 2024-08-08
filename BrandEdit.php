<?php  
session_start();
include('connect.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtname=$_POST['txtbrandname'];
	$txtID=$_POST['txtbrandname'];
    

	$Update="UPDATE supplier 
			 SET 
			 BrandName='$txtname' 
			 WHERE 
			 BrandID='$txtID'
			 ";
	$rett=mysqli_query($connection,$Update);
	
	if($rett) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='Brand.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
	}
}
$StaffID=$_GET['StaffID'];

$roleQuery="SELECT * FROM brand WHERE BrandID='$StaffID'";
$roleRet=mysqli_query($connection,$roleQuery);
$row=mysqli_fetch_array($roleRet);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>TK</title>
</head>
<body>
<div class="card2" >
  <div class="card-header2">
    <div class="text-header2">Update</div>
  </div>
  <div class="card-body2">
    <form action="BrandEdit.php" method="POST">
   
      <div class="form-group">
        <label for="username">Brand Name:</label>
        <input required="" class="form-control" name="txtbrandname" id="username" type="text"  value="<?php echo $row['BrandName']  ?>">
      </div>
	  
      
      <input type="hidden" name="brandID" value="<?php echo $row['BrandID'] ?>" />
     <input type="submit" class="btn" value="Update" name="btnUpdate">   
	 
	</form>
  </div>
</div>
</body>
</html>