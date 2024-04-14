<?php 
session_name('admin_session');

session_start();  



include "./templates/top.php"; 
include("./../functions.php");
?>
 
<?php include "./templates/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <h2><center>Admin Details</center></h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
             
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="admin_list">
          <?php
          $sql = "SELECT * FROM `user` WHERE is_admin = 1";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $res = $stmt->get_result();
          while ($admin = $res->fetch_object()) {
          ?>
            <tr>
              <td> <?php echo $admin->fullname ?></td>
              <td> <?php echo $admin->email ?></td>
              <td> 
  <?php 
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $admin->user_id) { 
      // Checking if session variable is set and not equal to current admin's ID
      if($admin->status == 1){
        echo '<p><a href="active_admin.php?user_id='.$admin->user_id.'&status=0" class="btn btn-success">Active</a></p>';
      } else {
        echo '<p><a href="active_admin.php?user_id='.$admin->user_id.'&status=1" class="btn btn-danger">Inactive</a></p>';
      } 
    } else {
      // Disabling options for the current admin
      if($admin->status == 1){
        echo '<p><button class="btn btn-success" disabled>Active</button></p>';
      } else {
        echo '<p><button class="btn btn-danger" disabled>Inactive</button></p>';
      } 
    }
  ?>
</td>
              

        <td>
                <?php
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $admin->user_id) { // Checking if session variable is set and not equal to current admin's ID
                  ?>
                  <a class="btn btn-sm btn-info">Edit</a>
                  <a class="btn btn-sm btn-warning">Delete</a>
                  <?php
                } else {
                  // Disabling options for the current admin
                  ?>
                  <a class="btn btn-sm btn-info"  >Edit</a>
                  <button class="btn btn-sm btn-warning" disabled>Delete</button>
                  <?php
                }
                ?>
              </td>
            </tr>
          </tbody>
          <?php
          } ?>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/admin.js"></script>
