<?php
session_start();
include 'container/Database.php';
include 'container/product.php';


$query="SELECT id,product_name,original_price,discounted_price,product_img FROM products";
$results=mysqli_query($db,$query) or die (mysqli_error($db));

if(isset($_POST['add'])){
   // echo $_POST['id'];
   if(isset($_SESSION['cart'])){
    $item_array_id= array_column($_SESSION['cart'],'id');
    //print_r ($item_array_id);
      //print_r ($_SESSION['cart']);
      if(in_array($_POST['id'],$item_array_id)){
        echo '<script>alert ("Product already added to cart")</script>';
        echo '<script>window.location="index.php"</script>';
      }else {
          $count=count($_SESSION['cart']);
          $item_array=array(
            'id'=>$_POST['id']
        );
        $_SESSION['cart'][$count]=$item_array;
        //print_r($_SESSION['cart']);
      }
   }else {
       $item_array=array(
           'id'=>$_POST['id']
       );
       //crating session variables
       $_SESSION['cart'][0]=$item_array;
       print $_SESSION['cart'];
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
<body>
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
    <a type="button" href="cart.php" class="nav-item nav-link active px-5">
     <span style="font-size:20px;font-weight:600;"> Cart&nbsp;</span>
    <i class="fas fa-shopping-cart fa-2x"></i>
    <?php
    if(isset($_SESSION['cart'])){
        $count=count($_SESSION['cart']);
        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning  ">
        '.$count.'
        <span class="visually-hidden">added</span>
        </span>';
    }else{
        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
        0
       <span class="visually-hidden">items</span>
        </span>';
    }
    ?>
     
    </a>
    </div>
    </div>
    </div>
    </header>

    <div class="container pb-5">
    <div class="row text-center py-5">
     <?php
     while($row=mysqli_fetch_assoc($results)){
         $pn=$row['product_name'];
         $op=$row['original_price'];
         $dp=$row['discounted_price'];
         $img=$row['product_img']; 
         $id=$row['id'];
     component($pn,$op,$dp,$img,$id);
     
     } ?>
    </div>
    </div>
    <footer class="sticky-footer bg-white h-25">
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