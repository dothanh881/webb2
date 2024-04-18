<?php 
session_name('admin_session');

session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php";
          include "./../functions.php";
    ?>


     <?php
     
     
     
     
     
     
     
     
     
     
     
     
     
     ?>
      
      <div class="container p-5">

<h4>Edit Product Detail</h4>
<?php
   // Get db for each product to edit
   if(isset($_GET['update'])){

    $update_id = $_GET['update'];
    $sql = "SELECT * FROM `product` WHERE `item_id` = $update_id ";

    $select = $conn->prepare($sql);
 
   
    $select->execute();
 
    $result = $select->get_result();

 
    if($result ->num_rows == 1){
      $row1 = $result->fetch_assoc();
        $category_id = $row1['category_id'];
        $status = $row1['item_status'];
        $rom = $row1['item_rom'];
        $ram = $row1['item_ram'];
        $color = $row1['item_color'];  
        $screen = $row1['size_screen'];
        $image = $row1['item_image'];
  // \getdb
?>






<form method="post"  enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="item_id" value="<?php echo $row1['item_id']  ?>" hidden>
    </div>
    
    <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="text" class="form-control" id="item_name" value="<?php echo $row1['item_name']  ?>">
    </div>
    <div class="form-group">
      <label for="desc">Product Description:</label>
      <input type="text" class="form-control" id="item_desc" value="<?php echo $row1['item_discription']  ?>">
    </div>
    <div class="form-group">
      <label for="price">Unit Price:</label>
      <input type="number" class="form-control" id="item_price" value="<?php echo  $row1['item_price'] ?>">
    </div>
   

   <div class="row">
    <div class="col-6">
    <div class="form-group">
		        		<label>Category Name</label>
		        	  <select id="category" class="form-control">
        <?php
        
        $sql="SELECT * from category WHERE category_id='$category_id'";
        $result = $conn-> query($sql);
        if ($result-> num_rows > 0){
          while($row = $result-> fetch_assoc()){
            echo"<option value='". $row['category_id'] ."'>" .$row['category_name'] ."</option>";
          }
        }
          
        ?>
          <?php
          $sql="SELECT * from category WHERE category_id!='$category_id'";
          $result = $conn-> query($sql);
          if ($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
              echo"<option value='". $row['category_id'] ."'>" .$row['category_name'] ."</option>";
            }
          }
        ?>
       
      </select>
		        	</div>
    </div>


    <div class="col-6">
    <div class="form-group">
		        		<label>Status Product</label>
		        		<select class="form-control status_list" name="status">
		        			 <option value="<?php echo $status ?> "><?php echo $status ?></option>
                <?php 

                  $sql = "SELECT distinct(item_status) FROM `product` WHERE item_status != $status";
                  $result = $conn->prepare($sql);
                  $result -> execute();

                  $status = $result ->get_result();

                  while($row = $status->fetch_assoc()){?>
                    <option value="<?= $row['item_status'] ?>"><?php echo $row['item_status'] ?></option>

                  <?php } ?>

                  
		        		</select>
		        	</div>
    </div>
   </div>
        		
        	

      <div class="row">
      <div class="col-6">
        			<div class="form-group">
		        		<label>ROM</label>
		        		<select class="form-control rom_list" name="item_rom" >
                <option value="<?php echo $rom ?> "><?php echo $rom ?></option>
                <?php 
            
$sql = "SELECT distinct(item_rom) FROM `product` WHERE item_rom != $rom ORDER BY item_rom asc" ;
$result = $conn->prepare($sql);
$result -> execute();

$rom = $result ->get_result();

while($row = $rom->fetch_assoc()){ ?>
  <option value="<?php echo $row['item_rom'] ?>"><?php echo $row['item_rom'] ?></option>


<?php } ?>
		        		
		        	
		        		</select>
		        	</div>
        		</div>
            <div class="col-6">
        			<div class="form-group">
		        		<label>RAM</label>
		        		<select class="form-control ram_list" name="item_ram">
		        	
                  <option value="<?php echo $ram ?> "><?php echo $ram ?></option>
                  <?php 
            
            $sql = "SELECT distinct(item_ram) FROM `product` WHERE item_ram != $ram ORDER BY item_ram asc" ;
            $result = $conn->prepare($sql);
            $result -> execute();
            
            $ram = $result ->get_result();
            
            while($row = $ram->fetch_assoc()){ ?>
              <option value="<?php echo $row['item_ram'] ?>"><?php echo $row['item_ram'] ?></option>
            
            
            <?php } ?>
		        		</select>
		        	</div>
        		</div>
      </div>
    
      <div class="row">
        <div class="col-6">
                <div class="form-group">
                  <label>Color</label>
                  <select class="form-control color_list" name="item_color">
                
                  <option value="<?php echo $color ?>"><?php echo $color ?></option>
                  <?php 
            // Đảm bảo rằng $color đã được định nghĩa trước khi sử dụng
            if(isset($color)){
                // Thêm dấu ngoặc kép xung quanh giá trị $color trong truy vấn SQL
                $sql = "SELECT DISTINCT item_color FROM `product` WHERE item_color != '$color'";
                $result = $conn->prepare($sql);
                $result->execute();
                $color_result = $result->get_result();

                while($row = $color_result->fetch_assoc()){ ?>
                    <option value="<?php echo $row['item_color'] ?>"><?php echo $row['item_color'] ?></option>
                <?php }
            }
            ?>
                  </select>
                </div>
        		</div>


            <div class="col-6">
        			<div class="form-group">
		        		<label>Screen</label>
		        		<select class="form-control ram_list" name="item_screen">
                <option value="<?php echo $screen ?>"><?php echo $screen ?></option>
                <?php 
            // Đảm bảo rằng $screen đã được định nghĩa trước khi sử dụng
            if(isset($screen)){
                
                $sql = "SELECT DISTINCT size_screen FROM `product` WHERE size_screen != '$screen' ORDER BY size_screen";
                $result = $conn->prepare($sql);
                $result->execute();
                $screen_result = $result->get_result();

                while($row = $screen_result->fetch_assoc()){ ?>
                    <option value="<?php echo $row['size_screen'] ?>"><?php echo $row['size_screen'] ?></option>
                <?php }
            }
            ?>

		        		</select>
		        	</div>
        		</div>
      </div>
            
   
      <div class="form-group">
         <img width='200px' height='150px' src='./../<?php echo $image ?>'>
         <div>
            <label for="file">Choose Image:</label>
            <input type="text" id="existingImage" class="form-control" value="<?php echo $row1['item_image']  ?>" hidden>
            <input type="file" id="newImage" value="">
         </div>
    </div>
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
    </div>
    
  </form>

  <?php }
  }else{
    echo '<p class="empty">no product found!</p>';
  }

  ?>
    </div>

  </div>
</div>



<?php include_once("./templates/footer.php"); ?>



