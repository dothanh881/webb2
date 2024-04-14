<?php
session_name('admin_session');

session_start();
include_once("./templates/top.php");
include_once("./templates/navbar.php");
include("./../functions.php");
?>
<div class="container-fluid">
  <div class="row">
    <?php include "./templates/sidebar.php"; ?>
    <div class="row">
      <div class="col-10">
        <h2>Customers</h2>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="customer_list">
          <?php
          $sql = "SELECT * FROM `user` WHERE is_admin = 0";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $res = $stmt->get_result();
          while ($cust = $res->fetch_object()) {
          ?>
            <tr>
              <td><?php echo $cust->fullname ?></td>
              <td><?php echo $cust->email ?></td>
              <td><?php echo $cust->phone_number ?></td>
              <td>
                <?php 
                if($cust->status == 1){
                  echo '<p><a href="active.php?user_id='.$cust->user_id.'&status=0" class="btn btn-success">Active</a></p>';
                }
                else{
                  echo '<p><a href="active.php?user_id='.$cust->user_id.'&status=1" class="btn btn-danger">Inactive</a></p>';
                }
                ?>
              </td>
              <td>
                <a class="btn btn-sm btn-info">Edit</a>
                <a class="btn btn-sm btn-warning">Delete</a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>
<script type="text/javascript" src="./js/customers.js"></script>
