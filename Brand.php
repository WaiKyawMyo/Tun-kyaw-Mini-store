<?php
  include('connect.php');
  session_start();
  $staffname=$_SESSION['StaffName'];
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
     $name=$_POST['txtbrandname'];
    
     //already exist checking
     $query="SELECT * FROM brand
             WHERE BrandName='$name'";
         $ret=mysqli_query($connection,$query);
         $count=mysqli_num_rows($ret);
         if($count> 0)
        {
            echo"<script>window.alert('Brand already exist !');</script>";
            echo"<script>window.location='Brand.php'</script>";
        }
        else{
            $insert="INSERT INTO brand
                     (BrandName)
                     VALUES 
                     ('$name')";
                     $ret=mysqli_query($connection,$insert);
                     
        }
        if($ret)
        {
            
            echo"<script>window.alert('Successfull saved!');</script>";
            echo"<script>window.location='Brand.php'</script>";
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

<a class="backtoProduct" href="<?php echo $staffpos ?>"><i class="fa-solid fa-arrow-left"></i> Back</a>

</div>
<form class="formcampsite" action="Brand.php" method="POST">
         <H3>Brand</H3>
        <label for="">Brand Name</label><br>
        <input type="text" name="txtbrandname" required placeholder="Name"><br>

      
       
        <input class="button" type="submit" name="btnregister" value="Register">
    </form>

    <div class="tabular--wrapper">
            <h3 class="main-title">
                Brand Info
            </h3>
            <div class="table-container">
            <?php
            $select = "SELECT * FROM brand";
            $ret=mysqli_query($connection,$select);
            $count= mysqli_num_rows($ret);

            if($count==0)
            {
                echo "<p> Admin Info Not Found</p>";
            }
            ?>      
                <table>
                    <thead>
                        <tr>
                        <th>Brand ID</th>
                        <th>
                            Brand Name
                        </th>
                        <th>Action</th>
                        
                        </tr>
                        <tbody>
                            <?php
                                for($i=0; $i<$count ; $i++)
                                {
                                    $row= mysqli_fetch_array($ret);

                                    $ID= $row['BrandID'];
                                    $Name= $row['BrandName'];
                                   
                                
                                    echo "<tr>";
                                    echo "<td>$ID</td>";
                                    echo "<td>$Name</td>";
                                    
                                    
                                    echo "<td>
                                        <a href='BrandEdit.php?StaffID=$ID'>Update</a>
                                    </td>";
                                    echo "</tr>";
                                }
                         ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
</body>
</html>