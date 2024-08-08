<?php
  include('connect.php');
  session_start();
  $staffname=$_SESSION['StaffName'];
  $StaffID=$_GET['StaffID'];
  $roleQuery="SELECT * FROM item WHERE ItemID='$StaffID'";
  $roleRet=mysqli_query($connection,$roleQuery);
  $row=mysqli_fetch_array($roleRet);
  $post=$_SESSION['StaffPosition'];
  if($post=='Staff' ){
    $staffpos='staffProduct.php';
  }else{
    $staffpos='Product.php';
  }
  if (!isset($_SESSION['StaffName']))
 {
     echo"<script>window.alert('Login Again!')</script>";
     echo"<script> window.location='StaffLogin.php'</script>";
 }
 if(isset($_POST['btnregister']))
 {
     $ID=$_POST['txtidto'];
     $whsale=$_POST['txtwhsalepri'];
     $retal=$_POST['txtretailpri'];
     $brandID=$_POST['cbobrand'];
    
     //already exist checking
    
            $insert="INSERT INTO price
                     (WholesalePrice,RetailSalePrice,ItemID)
                     VALUES 
                     ('$whsale','$retal','$ID')";
                     
         $insert2="INSERT INTO itembrand
                     (ItemID,BrandID)
                     VALUES 
                     ('$ID','$brandID')";
                $ret=mysqli_query($connection,$insert2);     
                $ret2=mysqli_query($connection,$insert); 
        if($ret)
        {
            echo"<script>window.alert('Successfull saved!');</script>";
            echo"<script>window.location='$staffpos'</script>";
        }
        else{
            echo"<p> Something went wrong : ". mysqli_error($connection) ."</p>" ;
        }
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>TK</title>
 </head>
 <body>
 <div class="header--wrapper">

<a class="backtoProduct" href="Product.php"><i class="fa-solid fa-arrow-left"></i> Back</a>

</div>
<form class="formcampsite" action="Price.php" method="POST">
         <H3>Price</H3>
        <label for="">Wholesesale Price</label><br>
        <input type="number" name="txtwhsalepri" required placeholder="XXXX"><br>

        <label for="">Retail Price</label><br>
        <input type="number" name="txtretailpri" required placeholder="XXXX"><br>

        <input type="Hidden" name="txtidto" required placeholder="" value="<?php echo $row['ItemID']  ?>"> 

        <label for="">Brand</label><br>
        <select name="cbobrand" id="">
        <?php
            $select= "SELECT * From brand";
            $run= mysqli_query($connection,$select);
            $count= mysqli_num_rows($run);

            for ($i=0;$i< $count; $i++)
            {
               $row= mysqli_fetch_array($run);
                $SID=$row['BrandID'];
               $Sname= $row['BrandName'];
               echo "<option value='$SID'> $Sname </option>";


            }
        ?>
     </select><br>
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>
 </body>
 </html>