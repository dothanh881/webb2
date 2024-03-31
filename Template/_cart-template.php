<!-- Shopping cart section  -->
<?php

   

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['delete-cart-submit'])){
            $deletedrecord = $Cart->deleteCart($_POST['item_id']);
        }

        // // save for later
        // if (isset($_POST['wishlist-submit'])){
        //     $Cart->saveForLater($_POST['item_id']);
        // }
    }

    if(isset($_POST['update_cart_qty'])){
        $qty = $_POST['update_quantity'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
        $update_id = $_POST['update_quantity_id'];
        
        // Chuẩn bị câu lệnh SQL với tham số ràng buộc
        $query = "UPDATE `cart` SET cart_quantity = ? WHERE item_id = ?";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($query);
        
        if($stmt){
            // Ràng buộc giá trị vào câu lệnh SQL
            $stmt->bind_param("ii", $qty, $update_id);
            
            // Thực thi câu lệnh SQL
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
    




       // Khai báo mảng để lưu trữ cart_quantity
     
       // Hiển thị sản phẩm trong giỏ hàng và cart_quantity
       foreach ($product->getData('cart') as $item) :
          
           // Tiếp tục hiển thị sản phẩm như bạn đã làm trước đó
       endforeach;
     
   
?>

 
            

<section id="cart" class="py-3 mb-5 mt-5">
    <div class="container-fluid w-75 ">
        <h5 class="font-baloo font-size-20  ">Shopping Cart</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9 ">
                <?php
            
                  
                    foreach ($product->getData('cart') as $item) :
                       
                        $cart = $product->getProduct($item['item_id']);
       
                        $subTotal[] = array_map(function ($item){

                ?>
                <!-- cart item -->
                <div class="row border-top py-3 mt-5">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['item_image'] ?? "./assets/products/img1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                        <small>by <?php echo $item['item_brand'] ?? "Brand"; ?></small>
                        <!-- product rating -->
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14"></a>
                        </div>
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                
                            

<div class="d-flex font-rale w-25">
    <form action="" method="post">
        <input type="hidden" name="update_quantity_id" value="<?php echo $item['item_id']  ?>">
        <input type="number" name="update_quantity" class="qty" min="1" max="99" value="<?php echo $cart_quantity ?>">
        <button type="submit" class="fas fa-edit" name="update_cart_qty"></button>
    </form>
</div>


                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                            </form>

                       

                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $item['item_price'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                            return $item['item_price'];
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