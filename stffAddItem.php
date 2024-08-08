<?php 
 include('connect.php');
  session_start();
  $staffname=$_SESSION['StaffName'];
  
  

  if (!isset($_SESSION['StaffName']))
  {
      echo"<script>window.alert('Login Again!')</script>";
      echo"<script> window.location='StaffLogin.php'</script>";
  }
  if(isset($_POST['btnregister']))
  {
      $cbopurchase=$_POST['cbopurchase'];
      $cboitem=$_POST['cboitem'];
      $txttoalprice=$_POST['txttoalprice'];
      $txtTotal=$_POST['txtTotal'];
      
     
      
     
      $insert="INSERT INTO purchaseitme
              (PurchaseID,ItemID,UnitItemTotalPrice,UnitTotalQuantity)
              VALUES 
              ('$cbopurchase','$cboitem','$txttoalprice','$txtTotal')";
                      
      $ret=mysqli_query($connection,$insert); 

      if($ret) {
          $roleQuery="SELECT * FROM item where ItemID='$cboitem'";
          $roleRet=mysqli_query($connection,$roleQuery);
          $row=mysqli_fetch_array($roleRet);

          $num=$row['UnitItemQuantity']+ $txtTotal;
          $Update="UPDATE item 
                   SET 
                   UnitItemQuantity='$num' 
                   WHERE 
                   ItemID='$cboitem'
                   ";
          $rett=mysqli_query($connection,$Update);

          if($rett) {
              $roleQuery2="SELECT * FROM purchase where PurchaseID='$cbopurchase'";
              $roleRett=mysqli_query($connection,$roleQuery2);
              $row2=mysqli_fetch_array($roleRett);

              $num2=$row2['TotalQuantity']+$txtTotal;
              $Update2="UPDATE purchase
                        SET 
                        TotalQuantity='$num2' 
                        WHERE 
                        PurchaseID='$cbopurchase'
                        ";
              $rett2=mysqli_query($connection,$Update2);

              if($rett2) {
                  echo"<script>window.alert('Successfully saved!');</script>";
                  echo"<script>window.location='stffAddItem.php'</script>";
              } else {
                  echo"<p> Something went wrong in Purchase Update: ". mysqli_error($connection) ."</p>" ;
              }
          } else {
              echo"<p> Something went wrong in Item Update: ". mysqli_error($connection) ."</p>" ;
          }
      } else {
          echo"<p> Something went wrong in Purchase Insert: ". mysqli_error($connection) ."</p>" ;
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="adminHOME">
<div class="sidebar">
        <div class="logo">
            
        </div>
        <ul class="menu">
            <li class="active">
                <a href="Realstaff.php" >
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
           
            <li>
                <a href="staffProduct.php">
                    <i class="fas fa-star"></i>
                    <span>Add New Product</span>
                </a>
            </li>
            <li>
                <a href="stffAddItem.php">
                <i class="fa-solid fa-plus"></i>
                    <span>Add Product</span>
                </a>
            </li>

            <li>
                <a href="staffbuy.php">
                <i class="fa-solid fa-shop"></i>
                    <span>Buy</span>
                </a>
            </li>
            <li>
                <a href="Staffsale.php">
                <i class="fa-solid fa-cart-shopping"></i>
                    <span>Sale</span>
                </a>
            </li>
            <li class="logout">
                <a href="StaffLogin.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            
        </ul>
    </div>
    <div class="main-content">
        <div class="header--wrapper">
            <div class="header--title">
                
                <h2>Add Product</h2><span>Welcome from Tun Kyaw mini store <?php echo $staffname; ?> </span>
             </div>
            <div class="user--info">
               
            <h1 class="Gee">TKMS</h1>
        </div>
        </div>
<form class="formcampsite" action="stffAddItem.php" method="POST">
         <H3>Add Product Item</H3>

         <label for="">Purchse Date</label><br>
        <select name="cbopurchase" id="">
        <?php
            $select= "SELECT * From purchase";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SID=$row['PurchaseID'];
               $Sname= $row['PurchaseDate'];
               echo "<option value='$SID'> $Sname </option>";


            }
        ?>
     </select><br>
     <label for="">Item</label><br>
        <select name="cboitem" id="">
        <?php
            $select= "SELECT * From item";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SID=$row['ItemID'];
               $Sname= $row['ItemName'];
               echo "<option value='$SID'> $Sname </option>";


            }
        ?>
     </select><br>
         <label for="">UnitITem TotalPrice</label><br>
        <input type="number" name="txttoalprice" required placeholder="XXX"><br>
        <label for="">Unit Total Quantity</label><br>
        <input type="number" name="txtTotal" required placeholder="XXXX"><br>

        

     

     
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>
</div>      
</body>
</html>