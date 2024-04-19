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
   <div class="container p-5">

<h4>Edit Customer Detail</h4>

<?php
// Get db for each product to edit
   if(isset($_GET['customer'])){

    $customer_id = $_GET['customer'];
    $sql = "SELECT * FROM `user` WHERE `user_id` = ? AND is_admin = 0 ";

    $select = $conn->prepare($sql);
    
    $select -> bind_param("s", $customer_id);
   
    $select->execute();
 
    $result = $select->get_result();

 
    if($result ->num_rows == 1){
      $row1 = $result->fetch_assoc();
        $user_id = $row1['user_id'];
        $city = $row1['city'];
      
        
        
  // \getdb
?>

<form method="post"  enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" name="user_id" value="<?php echo $row1['user_id']  ?>" hidden>
    </div>
    
    <div class="form-group">
      <label for="fullname">Full Name:</label>
      <input type="text" class="form-control" name="fullname" value="<?php echo $row1['fullname']  ?>">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" name="email" value="<?php echo $row1['email']  ?>">
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" name="phone" value="<?php echo $row1['phone_number']  ?>">
    </div>
    <div class="form-group">
      <label for="street">Street:</label>
      <input type="text" class="form-control" name="street" value="<?php echo $row1['street']  ?>">
    </div>


   <div class="row">
    <div class="col-6">
    <div class="form-group">
		        		<label>City: </label>
		        	  <select id="city" name="city" class="form-control">
                      <option value="<?php echo $city ?> "><?php echo $city ?></option>
        <?php
        
        if(isset($city)){
            $sql = "SELECT distinct(city) FROM `user` WHERE city != $city ";
            $result = $conn->prepare($sql);
            $result->execute();

            $city_user = $result->get_result();

            while($row = $city_user->fetch_assoc()){  ?>
              <option value="<?php echo $row['city'] ?>"><?php echo $row['city'] ?></option>

            <?php } 
            }
        ?>
       
      </select>
		        	</div>
    </div>


    <div class="col-6">
    <div class="form-group">
        <label>District: </label>
        <select class="form-control " name="district" >
            <option value="<?php echo $row1['district'] ?>"><?php echo $row1['district'] ?></option>
            <?php 
               $sql = "SELECT distinct(district) FROM `user` WHERE district != ?";
               $result = $conn->prepare($sql);
               $result->bind_param("s", $district_U);
               $result->execute();
   
               $district_user = $result->get_result();
   
               while($row = $district_user->fetch_assoc()){  ?>
                 <option value="<?php echo $row['district'] ?>"><?php echo $row['district'] ?></option>
   
               <?php } 
               
            ?>
        </select>
    </div>
</div>


   </div>
        		
        	

      
     
    <div class="form-group">
      <button type="submit" style="height:40px" name="update_btn" class="btn btn-primary">Update</button>
    </div>
    
  </form>

  <?php }
  }else{
    echo '<p class="empty">no product user!</p>';
  }

  ?>
    </div>

  </div>
</div>


<?php include_once("./templates/footer.php"); ?>