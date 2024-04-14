


<?php



  

  
session_name('admin_session');

session_start();

include('./../functions.php');


?>
  

	


<?php
    function input_filter($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['Login'])){
        // filter user_input
        $username = input_filter($_POST['username']);
        $password = input_filter($_POST['password']);
    
        // Tạo một kết nối đến cơ sở dữ liệu MySQL
    
        // escaping 
        $username = mysqli_real_escape_string($conn, $username);
    
        // Query template
        $query = "SELECT user_id, password FROM user WHERE `username`=? AND `is_admin` = 1 AND `status` = 1";
    
        // Chuẩn bị truy vấn
        $stmt = $conn->prepare($query);
    
        // Kiểm tra và xử lý lỗi nếu không thể chuẩn bị truy vấn
        if (!$stmt) {
            die("Error: " .$conn->error);
        }
    
        // Liên kết các biến với truy vấn
        $stmt->bind_param("s", $username);
    
        // Thực thi truy vấn
        $stmt->execute();
    
        // Lấy kết quả
        $result = $stmt->get_result();
    
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $hash_password = $row['password'];
    
            if(password_verify($password, $hash_password)){
                $_SESSION['admin'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                // $_SESSION['user_id'] = $row['user_id'];
                $admin = $_SESSION['admin'];
                header("location: index_admin.php");
                exit; // Ensure script stops here to prevent further execution
            }
        } else {
            echo "<script>alert('Incorrect username or password!')</script>";
        }
    
        // Đóng truy vấn và kết nối
        $stmt->close();
        $conn->close();
    }
    
    

?>






<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4 class="text-center">Admin Login</h4>
			<p class="message"></p>
			<form id="admin-login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" name="username" id="username"  placeholder="Enter username">
			    
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
			  </div>
			  <input type="hidden" name="admin_login" value="1">
			  <button type="submit" name="Login"  class="btn btn-success login-btn">Login</button>
			</form>
		</div>
	</div>
</div>





<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>
