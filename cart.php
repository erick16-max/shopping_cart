<?php
session_start();
include 'container/Database.php';
include 'container/product.php';

if (isset($_POST['delete'])){
   if($_GET['action']=='delete'){
        foreach($_SESSION['cart'] as $key=>$value){
            if($value['id']==$_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo '<script>alert ("Product removed from cart!")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <link rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
     <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="main.css">
</head>
<body class="bg-light">
    <header id="header">
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand">
    <h4 class="px-5">
    <i class="fas fa-shopping-basket fa-2x"></i>&nbsp;
    RickSide Shop
    </h4>
    </a>
    <button class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNavAltMarkUp"
    aria-controls="#navbarNavAltMarkUp"
    aria-expand="false"
    aria-label="Toggle navigation"
    >
    <span class="navbar-toggler-icon"></span>
    
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkUp">
    <div class="mr-auto"></div>
    <div class="navbar-nav">
    <a type="button" class="nav-item nav-link active px-5">
     <span style="font-size:20px;font-weight:600;"> Cart&nbsp;</span>
    <i class="fas fa-shopping-cart fa-2x"></i>
    <?php
    if(isset($_SESSION['cart'])){
        $count=count($_SESSION['cart']);
        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning  ">
        '.$count.'
       
        </span>';
    }else{
        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
        0
       <span class="visually-hidden">added</span>
        </span>';
    }
    ?>
     
    </a>
    </div>
    </div>
    </div>
    </header>
    <div class="container-fluid pb-3">
        <div class="row px-4">
            <div class="col-md-7">
                <div class="shopping-cart pt-">
                    <h6 class="text fw-bold">My Cart</h6>
                    <hr>
           <?php
           $total=number_format(0,2);
           $product_id=array_column($_SESSION['cart'],'id');
           $count_ids=count($product_id);
           if($count_ids==0){
           // print_r( $count_ids);
           echo '<h5 class="text text-danger px-5 py-5 mx-5">No Products Added in the Cart</h5>';
        }
           $sql="SELECT * FROM products";
            $results=mysqli_query($db,$sql) or die (mysqli_error($db));
            $total=0;
                if(isset($_SESSION['cart'])){
                    while($row=mysqli_fetch_assoc($results)){
                        foreach($product_id as $id){
                            if($row['id']==$id){
                             cart($row['product_name'],$row['discounted_price'],$row['product_img'],$row['id']);
                             $total=$total+$row['discounted_price'];
                            }
                        } 
                   
                 }
                }else {
                   
                }
           ?>
                </div>

            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25 pb-3">
                <div class="pt-4">
                <h6> <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> PRICE DETAILS</h6>
                <hr>
                <div  class="row price-details " style="padding:3% 2%;">
                    <div class="col-md-6">
                        <?php
                        if(isset($_SESSION['cart'])){
                            $count=count($_SESSION['cart']);
                            echo "<h6 >Price(".$count." items)</h6>";
                        }else {
                            echo "<h6>Price(0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery charges</h6>
                        <hr>
                        <h6 style="padding:3% 2%">Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>ksh. <?php echo number_format( $total,2);?></h6>
                        <h6 class="text text-success">FREE</h6>
                        <hr>
                        <h6>ksh. <?php echo number_format($total,2);?></h6>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="sticky-footer bg-white pt-3  h-25">
        <div class="container my-auto">
          <div class="copyright text-center my-auto pb-1">
          <span > Copyright © gege_254 &nbsp; <i class="fas fa-heart"></i> &nbsp;| RickSide Shop</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->


    <script src="vendors/jquery.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>