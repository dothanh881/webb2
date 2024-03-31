<?php

class Product
{
    public $conn = null;

    public function __construct($conn)
    {
        if (!$conn || $conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
    }

    // fetch product data using getData Method
    public function getData($table = 'product')
    {
        $result = $this->conn->query("SELECT * FROM {$table}");

        $resultArray = array();

        if ($result) {
            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
        }

        return $resultArray;
    }
    

    // get product using item id
    public function getProduct($item_id = null, $table = 'product')
    {
        if (isset($item_id)) {
            $result = $this->conn->query("SELECT * FROM {$table} WHERE item_id={$item_id}");

            $resultArray = array();

            if ($result) {
                // fetch product data one by one
                while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $resultArray[] = $item;
                }
            }

            return $resultArray;
        }
    }
}
?>
