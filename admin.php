<?php
    include 'db.php';

    if(isset($_POST['submit'])){
    $id = $_POST['Prod_ID'];
    $name = $_POST['Prod_name'];
    $price = $_POST['Price'];
    $stocks = $_POST['Stocks'];
    $image = $_POST['Prod_img'];

    $sql = "INSERT INTO product(Prod_ID, Prod_name, Price, Stocks, Prod_img) VALUES('$id', '$name', '$price', '$stocks', '$image')";
  
            if(!$conn->query($sql)){
                echo ("Insert Error!:".$conn->error);
            } 
            header("Location: admin.php");
            exit();
    }

    //UPDATE PRODS
    if(isset($_POST['update'])){
    $id = $_POST['Prod_ID'];
    $name = $_POST['Prod_name'];
    $price = $_POST['Price'];
    $stocks = $_POST['Stocks'];
    $image = $_POST['Prod_img'];

    $sql = "UPDATE product SET
    Prod_name = '$name',
    Price ='$price',
    Stocks = '$stocks',
    Prod_img = '$image'
    WHERE Prod_ID = '$id'";

            if(!$conn->query($sql)){
                echo ("Update Error!:".$conn->error);
            } 

            header("Location: admin.php");
            exit();
    }

    //DELETE
        if (isset($_GET['delete'])){
            $id = $_GET['delete'];
            $sql = "DELETE FROM product WHERE Prod_ID ='$id'";

            if(!$conn->query($sql)){
                echo ("Delete Error!:".$conn->error);
            } 

            header("Location: admin.php");
            exit();
        }

        //EDITTT
        $edit = null;
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $result = $conn->query("SELECT * FROM product WHERE Prod_ID ='$id'");
            $edit = $result->fetch_assoc();
           
        }

        //FETCHH
        $products = $conn->query("SELECT * FROM product");

if (!$products) {
    die("Fetch Error: " . $conn->error);
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pochi's Bake Shop</title>
    <link rel="shortcut icon" href="image/kittychef_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.3.8-examples/assets/dist/css/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        h1{
            font-weight:bold;
            margin:20px;
        }
        .container{
            margin:0% 15%;
            display:flex;
        }
        table{
            margin: 20px auto;
            border-collapse:collapse;
            background: #f9ecec;
            border:1px solid #333;
        }
        th{
            background-color:orange;
        }
        th, td{
            padding:10px;
        }
        img{
            width:70px; 
            height:70px; 
            object-fit:cover;
        }
        .btn-add, .btn-edit, .btn-delete{
            text-decoration:none;
            color:white;
            padding:8px;
            border-radius:12px;
            border:none;
        }
        .btn-edit{
            background:darkcyan;
        }
        .btn-delete{
            background:tomato;
        }
        .btn-add{
            background:limegreen;
        }
    </style>
</head>
<body>
    
        <center><h1>ADMIN PANEL</h1></center>
    <div class="container">
    <div class="left">
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
<th colspan="2">
<?= $edit ? "EDIT PRODUCT" : "ADD PRODUCT"; ?>
</th>
</tr>
            <tr>
                <td><b>Product ID:</b></td>
                <td><input type="number" name="Prod_ID" value="<?= $edit['Prod_ID'] ?? ''; ?>" <?= $edit ? "readonly" : "required";?>></td>
            </tr>

            <tr>
                <td><b>Product Name:</b></td>
                <td><input type="text" name="Prod_name" value="<?= $edit['Prod_name'] ?? '' ?>" required></td>
            </tr>

            <tr>
                <td><b>Price:</b></td>
                <td><input type="number" name="Price" value="<?= $edit['Price'] ?? '' ?>" required></td>
            </tr>

            <tr>
                <td><b>Stocks:</b></td>
                <td><input type="number" name="Stocks" value="<?= $edit['Stocks'] ?? '' ?>" required></td>
            </tr>

            <tr>
                <td><b>Product Image:</b></td>
                <td><input type="text" name="Prod_img" value="<?= $edit['Prod_img'] ?? '' ?>" required></td>
            </tr>

            <tr>
                <td colspan="2">
                <?php if($edit): ?>
                
                    <button type="submit" name="update" class="btn-edit">Update</button>
                    <a href="admin.php" class="btn-delete">Cancel</a>
                    <?php else: ?>
                    <button type="submit" name="submit" class="btn-add">Add Product</button>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        </form>
    </div>

    <div class="right">
        <table class="data-tbl">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stocks</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php while ($row = $products->fetch_assoc()): ?>
<tr>
<td><?= $row['Prod_ID']; ?></td>
<td><?= $row['Prod_name']; ?></td>
<td>₱<?= $row['Price']; ?></td>
<td><?= $row['Stocks']; ?></td>
<td><img src="image/<?= $row['Prod_img']; ?>"></td>
<td>
<a href="?edit=<?= $row['Prod_ID']; ?>" class="btn-edit">Edit</a>
<a href="?delete=<?= $row['Prod_ID']; ?>" class="btn-delete"
onclick="return confirm('Delete this product?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
    
            </tbody>
        </table>
    </div>

    </div>
    
    <script src="bootstrap-5.3.8-examples/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>