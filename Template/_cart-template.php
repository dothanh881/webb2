<!-- Shopping cart section  -->
<?php

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };
 

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['delete-cart-submit'])){
            $deletedrecord = $Cart->deleteCart($_POST['item_id']);
        }

      
    }
    if(isset($_POST['update_cart_qty'])){
        $qty = $_POST['update_quantity'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
        $update_id = $_POST['update_quantity_id'];
        $user_id = $_SESSION['user_id']; // Get the user_id from the session
        
        // Prepare the SQL statement with parameter binding
        $query = "UPDATE `cart` SET cart_quantity = ? WHERE item_id = ? AND user_id = ?";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($query);
        
        if($stmt){
            // Bind the values to the SQL statement parameters
            $stmt->bind_param("iis", $qty, $update_id, $user_id);
            
            // Execute the SQL statement
            if($stmt->execute()){
                $cartQuantities[$update_id] = $qty;
            } else {
                echo "Update failed";
            }
            
            $stmt->close();
        } else {
            echo "Error preparing statement";
        }
    }
    
?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                    foreach ($product->getData1('cart',$user_id) as $item) :
                        $cart = $product->getProduct1( $user_id,$item['item_id'],'cart');
                        $subTotal[] = array_map(function ($item){
                            $newQuantity = $item['cart_quantity'];
                            $newPrice = $item['cart_price'] * $newQuantity;
                ?>
                <!-- cart item -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['cart_image'] ?? "./assets/products/1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['name'] ?? "Unknown"; ?></h5>
                       
                        <!-- product rating -->
                        
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                          
                        <div class="d-flex font-rale w-35">
                        <form action="" method="post">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $item['item_id']  ?>">
                            <input type="number" name="update_quantity" class="qty" min="1" max="99" value="<?php echo $item['cart_quantity'] ?>">
                            <input type="submit"  class="btn btn-outline-primary btn-sm" value="Save for later" style="margin-left: 8px;" name="update_cart_qty">
                        </form>
                            </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn btn-outline-danger btn-sm mr-3 " style="margin-left: 10px;">Delete</button>
                            </form>

                           
                         

                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $newPrice ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                            return $newPrice;
                        }, $cart); // closing array_map function
                    endforeach;
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> item):&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></span> </span> </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Shopping cart section  -->