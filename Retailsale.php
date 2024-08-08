<?php
 include('connect.php');
 session_start();
 $staffname=$_SESSION['StaffName'];
 $totalforall=0;
 $Quantity=0;
 $post=$_SESSION['StaffPosition'];
 if($post=='Staff' ){
   $staffpos='staffProduct.php';
 }else{
   $staffpos='sale.php';
 }
 if (!isset($_SESSION['StaffName']))
{
    echo"<script>window.alert('Login Again!')</script>";
    echo"<script> window.location='StaffLogin.php'</script>";
}
 ;
 

if(isset($_POST['add_to_card'])){
 
    if(isset($_SESSION['cart'])){
     
        $session_array_id = array_column($_SESSION['cart'],"id");

        if(!in_array($_GET['id'], $session_array_id)) {
            $session_array= array(
                'id'=> $_GET['id'],
                "name" => $_POST['name'],
                "price" => $_POST['Price'],
                "quantity" => $_POST['quantity']
            );
            $_SESSION['cart'][] = $session_array;
        }
        
    }else{
        $session_array= array(
            'id'=> $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['Price'],
            "quantity" => $_POST['quantity']
        );
        $_SESSION['cart'][] = $session_array;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<a href="<?php echo $staffpos;  ?>" class="btn btn-warning btn-block"> Back </a>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Shoping Card Data</h2>
                    <div class="col-md-12">
                        <div class="row">

                        
                    <?php
                   
                    $query2 = "SELECT i.*, p.RetailSalePrice,p.PriceID FROM item i JOIN price p ON i.ItemID = p.ItemID ";
                    $result2= mysqli_query($connection,$query2);
                    

                    

                        while ($row = mysqli_fetch_array($result2)) {?>
                         <div class="col-md-4">
                            <form method="POST" action="Retailsale.php?id=<?= htmlspecialchars($row['ItemID']) ?>">
                                <img src="<?= $row['ItemImage1'] ?>" style="height:150px;" alt="" >
                                <h5 class="text-center"><?= $row['ItemName']; ?></h5>
                                <h5 class="text-center">$<?= number_format($row['RetailSalePrice'],2); ?></h5>
                                <input type="hidden" name="name" value="<?= $row['ItemName'] ?>">
                                
                                <input type="hidden" name="Price" value="<?= $row['RetailSalePrice'] ?>">
                                <input type="number" name="quantity" value="1" class="form-control">
                            <input type="submit" name="add_to_card" class="btn btn-warning btn-lg btn-block w-100 my-2" value="Add To Cart">    
                        </form>
                    </div>
                        <?php }

                    ?></div>
                    </div>
                    
                    
                    
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Retailsale Item Selected</h2>   
                    <?php
                      $total =0;  

                       $output = "
                       <table class='table table-bordered table-striped'>
                       <tr>
                       <th>
                       ID</th>
                       <th>Name</th>
                       <th>Item Price</th>
                       <th>Item Quentity</th>
                       <th> Total Price</th>
                       <th> Action</th>
                       </tr>

                        ";
                        if(!empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value){
                                $output .= "
                                <tr>
                                <td> ".$value['id']."</td>
                                <td> ".$value['name']."</td>
                                <td> ".$value["price"]."</td>
                                <td> ".$value['quantity']."</td>
                                <td>$".number_format($value['price'] * $value['quantity'],2)."</td>
                                <td> 
                                <a href='Retailsale.php?action=remove&id=".$value['id']."'> 
                                <button class='btn btn-danger btn-block'> Remove</button>
                                </a>
                                </td>
                                
                                
                                </tr>
                              
                                
                                ";  $Quantity=$Quantity+$value['quantity'];
                                 $total =$total + $value['quantity']* $value['price'];
                                $totalforall=$total;
                            }
                           $output .=" <tr><td colspan='3'>
                           
                            </td>  
                            
                            <td></b>TotalPrice</b></td>
                            <td>".number_format($total,2)."</td>
                            <td>
                            <a href='Retailsale.php?action=clearall'>
                           <button class='btn btn-warning btn-block' >Shop</button>
                           </a>
                            </td>
                            </tr>";
                        }
                        $output .= "</table>";
                        echo $output;
                      
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
         if(isset($_GET['action'])){
         if($_GET['action'] == "clearall"){
            $_SESSION['Dataall']=$_SESSION['cart'];
            $_SESSION['totalforall']=$totalforall;
            $_SESSION['Quantity']=$Quantity;
            echo"<script>window.alert('Shop Successfull');</script>";
    echo"<script>window.location='Customer.php'</script>";
            }

            if($_GET['action']== "remove"){
                foreach($_SESSION['cart'] as $key => $value) {
                    if($value['id']== $_GET['id']) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
            }
         }
    ?>
</body>
</html>