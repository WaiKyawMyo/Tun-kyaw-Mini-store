<?php  

include('connect.php');
if (isset($_GET['StaffID']))
{
	$AID=$_REQUEST['StaffID'];
    $select= "SELECT * From staff where StaffID='$AID'";

    $ret= mysqli_query($connection,$select);
    $row = mysqli_fetch_array($ret);

    $ID=$row['StaffID'];
    $Name=$row['StaffName'];
	 $position=$row['StaffPosition'];
    $Address=$row['StaffAddress'];
    $StPhonenumber=$row['StaffPhoneNumber'];
	 $Stemail=$row['StaffEmail'];
    $password= $row['StaffPassword'];
    
}





if(isset($_POST['btnupdate'])) 
{
	$txtStaffID=$_POST['txtStaffID'];
	$txtStaffName=$_POST['txtStaffName'];
    $txtpositon=$_POST['txtpositon'];
    $txtStaffAddress=$_POST['txtStaffAddress'];
	$txtStaffphone=$_POST['txtStaffphone'];
    $StaffEmail=$_POST['txtStaffemail'];
    $txtStaffpassword=$_POST['txtpassword'];
    

	$Update="UPDATE staff Set
			 StaffName='$txtStaffName',StaffPosition='$txtpositon',StaffAddress='$txtStaffAddress',StaffPhoneNumber='$txtStaffphone',StaffEmail='$StaffEmail',
			 StaffPassword='$txtStaffpassword' 
			 WHERE StaffID='$txtStaffID'";
	$rett=mysqli_query($connection,$Update);
	if($rett) 
	{
    echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='StaffRegister.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>
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
    <form action="StaffRegisterEdit.php" method="POST">
   
      <div class="form-group">
        <label for="username">Staff Name:</label>
        <input required="" class="form-control" name="txtStaffName" id="username" type="text"  value="<?php echo $Name ?>">
      </div>
      <div class="form-group">
        
		 <Select name="txtpositon"  >
		
		
     <option <?php if($position =="Owner" ) echo"selected"?> value="Owner">Owner </option>;
			<option <?php if($position =="Staff" ) echo"selected"?> value="Staff">Staff </option>;
		
		</Select>
      </div>
      <div class="form-group">
        <label for="Address">Staff Address:</label>
        <input required="" class="form-control" name="txtStaffAddress" id="Address" type="text" value="<?php echo $Address  ?>">
      </div>
      <div class="form-group">
        <label for="phoneumber">Phone Number:</label>
        <input required="" class="form-control" name="txtStaffphone" id="phoneumber" type="text" value="<?php echo $StPhonenumber  ?>">
      </div>
	  <div class="form-group">
        <label for="stemail">Email:</label>
        <input required="" class="form-control" name="txtStaffemail" id="stemail" type="email" value="<?php echo $Stemail ?>">
      </div>
	  <div class="form-group">
        <label for="password">Password:</label>
        <input required="" class="form-control" name="txtpassword" id="password" type="password" value="<?php echo $password  ?>">
      </div>
      <input type="hidden" name="txtStaffID" value="<?php echo $ID ?>" />
     <input type="submit" class="btn" value="Update" name="btnupdate">   
	 
	</form>
  </div>
</div>

</body>
</html>