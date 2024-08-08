<?php  
session_start();
include('connect.php');
$post=$_SESSION['StaffPosition'];
  if($post=='Staff' ){
    $staffpos='staffbuy.php';
  }else{
    $staffpos='buy.php';
  }
if(isset($_POST['btnUpdate'])) 
{
	$txtpurchasedate=$_POST['txtpurchasedate'];
	$txttotalamount=$_POST['txttotalamount'];

    $cbosupplier=$_POST['cbosupplier'];
	$cbostaff=$_POST['cbostaff'];
    $txtpurchaseid=$_POST['txtpurchaseID'];
   
    

	$Update="UPDATE purchase 
			 SET 
			 PurchaseDate='$txtpurchasedate',TotalAmount='$txttotalamount',SupplierID='$cbosupplier',StaffID='$cbostaff'
			 WHERE 
			 PurchaseID='$txtpurchaseid'
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

$roleQuery="SELECT * FROM purchase WHERE PurchaseID='$StaffID'";
$roleRet=mysqli_query($connection,$roleQuery);
$row=mysqli_fetch_array($roleRet);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card2" >
  <div class="card-header2">
    <div class="text-header2">Update</div>
  </div>
  <div class="card-body2">
    <form action="BuyEdit.php" method="POST">
   
      <div class="form-group">
        <label for="username">Purchase Date:</label>
        <input required="" class="form-control" name="txtpurchasedate" id="username" type="Date"  value="<?php echo $row['PurchaseDate']  ?>">
      </div>
	  <div class="form-group">
        <label for="amont">Total Amount:</label>
        <input required="" class="form-control" name="txttotalamount" id="amont" type="Number" value="<?php echo $row['TotalAmount'] ?>">
      </div>


	  
     
      <div class="form-group">
      <label for="">Supplier Name</label><br>
        <select  name="cbosupplier" id="">
        <?php
            $select= "SELECT * From supplier";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SuID=$row['SupplierID'];
               $Suname= $row['SupplierName'];
               echo "<option value='$SuID'> $Suname </option>";


            }
        ?>
     </select><br> 
     </div>

     <div class="form-group">
     <label for="">Staff Name</label><br>
        <select name="cbostaff" id="">
        <?php
            $select= "SELECT * From staff";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SID=$row['StaffID'];
               $Sname= $row['StaffName'];
               echo "<option value='$SID'> $Sname </option>";


            }
        ?>
     </select><br>
     </div>
      
     <input type="hidden" name="txtpurchaseID" value="<?php echo $StaffID;?>" />
     <input type="submit" class="btn" value="Update" name="btnUpdate">   
	 
	</form>
  </div>
</div>
</body>
</html>