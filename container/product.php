<?php
function component($productName,$productPrice1,$productPrice2,$productImage,$id){
   $card='
   <div class="col-md-3 col-sm-3 my-3 my-md-0"> 
   <form action="index.php" method="post">
   <div class="card shadow">
   <div>
   <img src="'.$productImage.'" class="img-fluid card-img-top" alt="" >
   </div>
   <div class="card-body">
   <h5 class="card-title">'.$productName.'</h5>
   <h6>
   <i class="fas fa-star"></i>
   <i class="fas fa-star"></i>
   <i class="fas fa-star"></i>
   <i class="fas fa-star"></i>
   <i class="far fa-star"></i>
   </h6>
   <p class="card-text">
   The information about this product features
   </p>
   <h5>
   <small><s class="text-danger">'.$productPrice1.'</s></small>
   <span class="price">'.$productPrice2.'</span>
   </h5>
   <button name="add" class="btn btn-warning my-3" type="submit">Add to Cart <i class="fas fa-shopping-cart"></i></button>
   <input type="hidden" value="'.$id.'" name="id">
   </div>
   </div>
   </form>
   </div>';
   echo $card;
}
function cart($pn,$pp,$pg,$product_id){
   $cart='
   <form action="cart.php?action=delete&id='.$product_id.'" method="post" class="cart-items" >
   <div class="row bg-white">
       <div class="col-md-3 bg-light">
           <img src="'.$pg.'" alt="photo" class="img-fluid"  >
       </div>
       <div class="col-md-6">
           <h6 class="pt-2">'.$pn.'</h6>
           <small class="text-secondary">Dealer:Samsung</small>
           <h6 class="pt-2">Ksh ' .number_format($pp,2).'</h6>
           <button type="submit" class="btn btn-warning">Save For Later</button>
           <button type="submit" class="btn btn-danger mx-2" name="delete">Remove</button>
       </div>
       <div class="col-md-3 py-5">
           <button class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
           <input type="text" value="1" class="form-control w-25 d-inline" name="qty" id="qty">
           <button class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
       </div>
   </div>

</form>   ';
echo $cart;
}

?>