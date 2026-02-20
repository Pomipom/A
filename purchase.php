<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product_id = $_POST['Prod_ID'] ?? ''; 
    $quantity = $_POST['quantity'] ?? 0;
    $client_name = $_POST['client_name'] ?? 'Unknown'; 
    $client_contact = $_POST['client_contact'] ?? 'Unknown';

    // GET PRODUCT DATA FROM DATABASE
    $sql = "SELECT Prod_name, Prod_img, Price, Stocks FROM product WHERE Prod_ID = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    if(!$product){
        die("Product not found.");
    }

    $price = $product['Price'];
    $current_stock = $product['Stocks'];
    $total_price = $price * $quantity; 

    // STOCK CHECK
    if($quantity > $current_stock){
        echo "<script>
    alert('Order exceeds available stocks!');
    window.location.href = 'products.php';
    </script>";
    }

    // INSERT ORDER - Fixed array keys and variable names
    $insert = "INSERT INTO orders(order_name, order_img, quantity, total, client_name, client_contact) 
    VALUES('{$product['Prod_name']}', 
           '{$product['Prod_img']}',
           '$quantity',
           '$total_price', 
           '$client_name',
           '$client_contact')";
    
    $conn->query($insert); 

    // UPDATE STOCK
    $new_stock = $current_stock - $quantity; 
    $sql_update = " UPDATE product SET Stocks = '$new_stock' WHERE Prod_ID = '$product_id'"; 
    
    mysqli_query($conn, $sql_update);

    echo "<script>
    alert('Order placed successfully!');
    window.location.href = 'products.php';
    </script>";
}

?>
