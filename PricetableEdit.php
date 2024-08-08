<?php  
session_start();
include('connect.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtwhpric=$_POST['txtwhprice'];
	$retailprice=$_POST['retailprice'];
	$priceID=$_POST['priceID'];
    

	$Update="UPDATE price 
			 SET 
			 WholesalePrice='$txtwhpric',RetailSalePrice='$retailprice' 
			 WHERE 
			 PriceID ='$priceID'
			 ";
	$rett=mysqli_query($connection,$Update);
	
	if($rett) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='Product.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
	}
}
$StaffID=$_GET['StaffID'];

$roleQuery="SELECT * FROM price WHERE PriceID='$StaffID'";
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
    <form action="PricetableEdit.php" method="POST">
   
      <div class="form-group">
        <label for="username">Wholesale Price :</label>
        <input required="" class="form-control" name="txtwhprice" id="username" type="text"  value="<?php echo $row['WholesalePrice']  ?>">
      </div>
	  <div class="form-group">
        <label for="retailpric">RetailSale Price :</label>
        <input required="" class="form-control" name="retailprice" id="retailpric" type="text"  value="<?php echo $row['RetailSalePrice']  ?>">
      </div>
      
      <input type="hidden" name="priceID" value="<?php echo $row['PriceID'] ?>" />
     <input type="submit" class="btn" value="Update" name="btnUpdate">   
	 
	</form>
  </div>
</div>
</body>
</html>