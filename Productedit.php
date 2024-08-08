<?php  
session_start();
include('connect.php');
$post=$_SESSION['StaffPosition'];
  if($post=='Staff' ){
    $staffpos='staffProduct.php';
  }else{
    $staffpos='Product.php';
  }
if(isset($_POST['btnUpdate'])) 
{
	$txtItemID=$_POST['txtItemID'];
	$txtItemName=$_POST['txtItemName'];
    $txtUnitItemQuantity=$_POST['txtUnitItemQuantity'];
   
	
  $Attractionimg1 = $_FILES['txtItemImage1']['name'];
    $folder = "Photo/";
    $finename = $folder . "_" . $Attractionimg1;
    $copy = copy($_FILES['txtItemImage1']['tmp_name'], $finename);
    if (!$copy) {
        echo "<p>Cannot upload image 1</p>";
        exit();
    }
    $Attractionimg2 = $_FILES['txtItemImage2']['name'];
    $finename2 = $folder . "_" . $Attractionimg2;
    $copy2 = copy($_FILES['txtItemImage2']['tmp_name'], $finename2);
    if (!$copy2) {
        echo "<p>Cannot upload image 2</p>";
        exit();
    }
    
    $txtItemDetail=$_POST['txtItemDetail'];
    $txtStatus=$_POST['txtStatus'];

	$Update="UPDATE item 
			 SET 
			 ItemName='$txtItemName',UnitItemQuantity='$txtUnitItemQuantity',ItemImage1='$finename',ItemImage2='$finename2',
			 ItemDetail='$txtItemDetail',Status='$txtStatus'
			 WHERE 
			 ItemID='$txtItemID'
			 ";
	$rett=mysqli_query($connection,$Update);
	
	if($rett) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='$staffpos'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
	}
}
$StaffID=$_GET['StaffID'];

$roleQuery="SELECT * FROM item WHERE ItemID='$StaffID'";
$roleRet=mysqli_query($connection,$roleQuery);
$row=mysqli_fetch_array($roleRet);

?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="style.css">
	<title>Item Edit</title>
</head>
<body>


<div class="card2" >
  <div class="card-header2">
    <div class="text-header2">Update</div>
  </div>
  <div class="card-body2">
    <form action="Productedit.php" method="POST" enctype="multipart/form-data">
   
      <div class="form-group">
        <label for="username">Item Name:</label>
        <input required="" class="form-control" name="txtItemName" id="username" type="text"  value="<?php echo $row['ItemName']  ?>">
      </div>
	  <div class="form-group">
        <label for="UnitItemQuantity">Unit Item Quantity:</label>
        <input required="" class="form-control" name="txtUnitItemQuantity" id="UnitItemQuantity" type="number" value="<?php echo $row['UnitItemQuantity'] ?>">
      </div>


	  
      <div class="form-group">
        <label for="ItemImage1">Item Image 1:</label>
        <input required="" class="form-control" name="txtItemImage1" id="ItemImage1" type="file" value="<?php echo $row['ItemImage1']  ?>">
      </div>
	  <div class="form-group">
        <label for="ItemImage2">Item Image 2:</label>
        <input required="" class="form-control" name="txtItemImage2" id="ItemImage2" type="file" value="<?php echo $row['ItemImage2']  ?>">
      </div>
      <div class="form-group">
        <label for="ItemDetail">Item Detail:</label>
        <input required="" class="form-control" name="txtItemDetail" id="ItemDetail" type="Text" value="<?php echo $row['ItemDetail']  ?>">
      </div>
      <div class="form-group">
        <label for="Status">Status:</label>
        <input required="" class="form-control" name="txtStatus" id="Status" type="Text" value="<?php echo $row['Status']  ?>">
      </div>
	  
      
      <input type="hidden" name="txtItemID" value="<?php echo $row['ItemID'] ?>" />
     <input type="submit" class="btn" value="Update" name="btnUpdate">   
	 
	</form>
  </div>
</div>

</body>
</html>