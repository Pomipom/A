<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Pochi's Bake Shop</title>
    <link rel="shortcut icon" href="image/kittychef_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap-5.3.8-examples/assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
    section{
        margin: 5%;
    }
    h1{
      font-weight:bold;
      margin-bottom:15px;
      color:rgb(241, 158, 103);
    }
    .prod-grid{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        text-align: center;
    }
    .prod-card{
        width: 100%;
      height: auto;
      box-shadow: 2px 4px 6px  rgba(0,0,0,0.2);
      border-radius:10px;
      padding-bottom:10px;
    }
    .prod-card img{
      object-fit: cover;
      max-height:auto;
      width: 100%;
      border-radius: 12px;
    }
    .label h5{
      margin-top:8px;
    }
    .label p{
    margin:0;
    }
    button{
      margin:5px;
      border: none;
      padding:8px 10px;
      border-radius: 12px;
      font-weight:600;
    }
    .add-cart{
      background-color: rgb(235, 235, 133);
    }
    .buy-now{
      background-color: rgb(237, 192, 109);
      color:white;
      padding:5px 30px;
      font-size: 17px;
      box-shadow:2px 4px 6px  rgba(0,0,0,0.2);
    }
    .buy-now:hover{
      background-color: rgb(255, 249, 242);
      color:rgb(237, 192, 109);
      box-shadow:2px 4px 6px  rgba(0,0,0,0.2);
    }
    .confirm-btn{
      background-color:rgb(165, 216, 89);
      border: none;
      padding:8px 10px;
      border-radius: 15px;
      color: white;
      font-weight: bold;
    }
    .confirm-btn:hover {
      background-color:white;
      border: none;
      padding:8px 10px;
      border-radius: 15px;
      color: rgb(165, 216, 89);
      font-weight: bold;
      box-shadow: 2px 4px 6px  rgba(0,0,0,0.1);
    }
    #modalTotalAmount{
      color:tomato;
      font-weight:bold;
    }
    </style>
</head>
<body>
    <header>
         <nav
        class="navbar navbar-expand-md"
        aria-label="Fourth navbar example"
      >
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img class="logo" src="image/kittychef_logo.png" alt="Logo" style="border-radius:100%;
          object-fit:cover;height:70px;width:70px;"></a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarsExample04"
            aria-controls="navbarsExample04"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item"><a class="nav-link active" href="products.php">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item dropdown">
                
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section>
    <h1 class="text-center">Products</h1>

     <?php
    include 'db.php';

    $sql = "SELECT * FROM product WHERE Stocks > 0";
    $result = $conn->query(query:$sql);
    ?>
    <div class="prod-grid">

    <?php
    if($result->num_rows >0){
        while($product = $result->fetch_assoc()) {
    ?>
        <div class="prod-card">
            <div class="img-holder">
                <img src="image/<?php echo $product['Prod_img']; ?>" alt="Product Image">
            </div>

            <div class="label">
                <h5><?php echo $product['Prod_name']; ?></h5>
                <p>₱<?php echo number_format(num: $product['Price'], decimals: 2); ?></p>
                <p>Stocks: <?php echo $product['Stocks']; ?></p>
            </div>
            
            <div class="btn-group">
                <!--<button class="add-cart" onclick="addToCart(</?php echo $product['Prod_ID']; ?>)">
                    Add To Cart
                </button>-->

                <button class="buy-now" onclick="openBuyNow(<?php echo $product['Prod_ID']; ?>,
                '<?php echo addslashes (string: $product['Prod_name']); ?>',
                <?php echo number_format($product['Price'], decimals:2); ?>,
                <?php echo $product['Stocks']; ?>,
                '<?php echo $product['Prod_img']; ?>'
                )">
                    Buy Now
                </button>
            </div>
            
        </div>
<?php
        }
    } else {
        echo "<p>No products available.</p>";
    }
    $conn->close();
?>
    </div>
    </section>
    
    <div class="modal fade" id="buyNowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Purchase Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body text-center">
            <form id="buyNowForm" method="POST" action="purchase.php">

                <input type="hidden" name="Prod_ID" id="modalProductId">

                <img id="modalProductImage"
                src="image/ " alt="Product Image"
                class="img-fluid mb-3"
                style="max-height:200px; object-fit:contain;">

                <p><strong>Product:</strong> <span id="modalProductName"></span> </p> 
                <p><strong>Price:</strong> <span id="modalProductPrice"></span> </p> 
                <p><strong>Available Stocks:</strong> <span id="modalProductStocks"></span></p> 

                <div class="mb-3 text-start">
                    <label>Quantity</label>
                    <input type="number" name="quantity" id="modalQuantity" class="form-control" value="1" min="1" oninput="updateTotal()">

                    <label>Name</label>
                    <input type="text" name="client_name" id="modalClientName" class="form-control" required>

                    <label>Contact</label>
                    <input type="tel" name="client_contact" id="modalClientContact" class="form-control" maxlength="11" required>

                    <p class="mt-3">
                        <strong>Total Amount:</strong>
                        ₱<span id="modalTotalAmount">0.00</span>
                    </p>

                </div>
                <button class="confirm-btn" type="submit" class="btn-success w-100">Confirm Purchase</button>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="container">
      <footer
        class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"
      >
        <p class="col-md-4 mb-0 text-body-secondary">
          &copy; 2025 Company, Inc
        </p>
        <a href="index.php"><img class="logo" src="image/kittychef_logo.png" alt=""></a>
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item">
            <a href="index.php" class="nav-link px-2 text-body-secondary">Home</a>
          </li>
          <li class="nav-item">
            <a href="products.php" class="nav-link px-2 text-body-secondary">Products</a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="nav-link px-2 text-body-secondary">About Us</a>
          </li>
          <li class="nav-item">
            <a href="contact.php" class="nav-link px-2 text-body-secondary">Contact Us</a>
          </li>
        </ul>
      </footer>
    </div>


    <script>
      let currentPrice = 0;
      let maxStocks = 0;

    function openBuyNow(id, name, price, stocks, image){
        currentPrice = price;
        maxStocks = stocks;

        document.getElementById("modalProductId").value = id;
        document.getElementById("modalProductName").innerText = name;
        document.getElementById("modalProductPrice").innerText = price.toFixed(2);
        document.getElementById("modalProductStocks").innerText = stocks;

        document.getElementById("modalProductImage").src = 
        "image/" + image;

       const qtyInput =  document.getElementById("modalQuantity");
       qtyInput.value = 1;
       qtyInput.max = stocks;

        updateTotal();

        let modal = new bootstrap.Modal(document.getElementById("buyNowModal"));
        modal.show();
    }

    function updateTotal(){
        let qty = document.getElementById("modalQuantity").value;
        if(qty > maxStocks){
          qty = maxStocks;
          document.getElementById("modalQuantity").value = maxStocks;
        }

        if (qty < 1 || isNaN(qty)){
          qty = 1;
          document.getElementById("modalQuantity").value = 1;
        }

        let total = currentPrice * qty;

        document.getElementById("modalTotalAmount").innerText = total.toFixed(2);
}
    </script>
    <script src="bootstrap-5.3.8-examples/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>