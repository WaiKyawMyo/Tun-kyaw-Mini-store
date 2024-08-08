<?php  
session_start();
include('connect.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtSupplierID=$_POST['txtSupplierID'];
	$txtSuppliername=$_POST['txtSuppliername'];
    $txtSupplieremail=$_POST['txtSupplieremail'];
    $txtSupplieraddress=$_POST['txtSupplieraddress'];
	$txtSupplierphone=$_POST['txtSupplierphone'];
    $txtReturn=$_POST['txtReturn'];
    $SupplierType=$_POST['SupplierType'];
    

	$Update="UPDATE supplier 
			 SET 
			 SupplierName='$txtSuppliername',SupplierEmail='$txtSupplieremail',SupplierAddress='$txtSupplieraddress',SupplierPhoneNumber='$txtSupplierphone',SupplierReturn='$txtReturn',
			 SupplierType='$SupplierType' 
			 WHERE 
			 SupplierID='$txtSupplierID'
			 ";
	$rett=mysqli_query($connection,$Update);
	
	if($rett) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='Supplier.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
	}
}
$StaffID=$_GET['StaffID'];

$roleQuery="SELECT * FROM supplier WHERE supplierID='$StaffID'";
$roleRet=mysqli_query($connection,$roleQuery);
$row=mysqli_fetch_array($roleRet);

?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="style.css">
	<title>Supplier Edit</title>
</head>
<body>


<div class="card2" >
  <div class="card-header2">
    <div class="text-header2">Update</div>
  </div>
  <div class="card-body2">
    <form action="Supplieredit.php" method="POST">
   
      <div class="form-group">
        <label for="username">Supplier Name:</label>
        <input required="" class="form-control" name="txtSuppliername" id="username" type="text"  value="<?php echo $row['SupplierName']  ?>">
      </div>
	  <div class="form-group">
        <label for="Address">Supplier Email:</label>
        <input required="" class="form-control" name="txtSupplieremail" id="Address" type="email" value="<?php echo $row['SupplierEmail'] ?>">
      </div>


	  <div class="form-group">
        <label for="Address">Supplier Address:</label>
        <input required="" class="form-control" name="txtSupplieraddress" id="Address" type="text" value="<?php echo $row['SupplierAddress']  ?>">
      </div>
      <div class="form-group">
        <label for="phoneumber">Phone Number:</label>
        <input required="" class="form-control" name="txtSupplierphone" id="phoneumber" type="text" value="<?php echo $row['SupplierPhoneNumber']  ?>">
      </div>
	  
      <div class="form-group">
	   <label for="phoneumber">Return:</label>
		 <Select name="txtReturn"  >
		
		
		 <option <?php if($row['SupplierReturn'] =="True" ) echo"selected"?> value="True">True </option>;
			<option <?php if($row['SupplierReturn'] =="Flase" ) echo"selected"?> value="Flase">Flase </option>;
		
		</Select>
      </div>
	  <div class="form-group">
	   <label for="phoneumber">Supplier Type:</label>
		 <Select name="SupplierType"  >
		
		
		 <option <?php if($row['SupplierType'] =="Company" ) echo"selected"?> value="Company">Company </option>;
			<option <?php if($row['SupplierType'] =="Whole sale" ) echo"selected"?> value="Whole sale">Whole sale </option>;
		
		</Select>
      </div>
      
      <input type="hidden" name="txtSupplierID" value="<?php echo $row['SupplierID'] ?>" />
     <input type="submit" class="btn" value="Update" name="btnUpdate">   
	 
	</form>
  </div>
</div>

</body>
</html>