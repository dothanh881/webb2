<?php
// functions.php

// include connect.php
include('connect.php');

// require Product Class
require('database/Product.php');
require('database/Cart.php');

// create Product object with the connection
$product = new Product($conn);

// get product data
$product_shuffle = $product->getData();

$Cart = new Cart($conn);
?>