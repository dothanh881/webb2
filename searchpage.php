<?php include("header.php"); ?>

<style>
    .advance_search {
        margin-bottom: 20px;
    }

    .hd_box_search {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .b_inputOfSearch {
        display: flex;
        flex-direction: column;
    }

    .b_inputOfSearch .form-group {
        margin-bottom: 10px;
    }
</style>

<section class="search-form">
    <form action="" method="post">
        <input type="text" name="search_box" placeholder="Search here..." maxlength="100" class="box" required>
        <button type="submit" class="fas fa-search" name="search_btn"></button>
    </form>
</section>

<section id="bd_search_result">
    <?php
    if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
        $search_box = $_POST['search_box'];

        // Kết nối tới cơ sở dữ liệu MySQLi
        // (Assuming $conn is your database connection)

        $limit = 5; // Số lượng sản phẩm trên mỗi trang
        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
        $start = ($page - 1) * $limit; // Vị trí bắt đầu của kết quả trên trang này

        // Thực hiện truy vấn để đếm số sản phẩm
        $count_query = "SELECT COUNT(*) as total FROM `product` WHERE item_name LIKE '%$search_box%'";
        $count_result = $conn->query($count_query);
        $row = $count_result->fetch_assoc();
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $limit); // Tính tổng số trang

        // Truy vấn SQL với LIMIT
        $sql = "SELECT * FROM `product` WHERE item_name LIKE '%$search_box%' LIMIT $start, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="advance_search">';
            echo '<div class="hd_box_search">SEARCH</div>';
            echo '<div class="b_inputOfSearch form-row">';
            while ($fetch_product = $result->fetch_assoc()) {
                ?>
                <div class="form-group col-md-3">
                    <div class="grid-item border <?php echo $fetch_product['item_brand'] ?? "Brand"; ?>">
                        <div class="item py-2" style="width: 200px;">
                            <div class="product font-rale">
                                <a href="<?php printf('%s?item_id=%s', 'product.php', $fetch_product['item_id']); ?>"><img
                                            src="<?php echo $fetch_product['item_image'] ?? "./assets/products/13.png"; ?>" alt="product1"
                                            class="img-fluid"></a>
                                <div class="text-center">
                                    <h6>
                                        <?php echo $fetch_product['item_name'] ?? "Unknown"; ?>
                                    </h6>
                                    <div class="price py-2">
                                        <span>$<?php echo $fetch_product['item_price'] ?? 0 ?></span>
                                    </div>
                                    <form method="post">
                                        <input type="hidden" name="pid" value="<?= $fetch_product['item_id']; ?>">
                                        <input type="hidden" name="name" value="<?= $fetch_product['item_name']; ?>">
                                        <input type="hidden" name="price" value="<?= $fetch_product['item_price']; ?>">
                                        <input type="hidden" name="image" value="<?= $fetch_product['item_image']; ?>">
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>'; // .b_inputOfSearch
            echo '</div>'; // .advance_search
        } else {
            echo '<p class="empty">No products found!</p>';
        }
    }
    ?>
</section>

<?php include("footer.php"); ?>
