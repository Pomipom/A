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
        margin: 5% auto;
        max-width: 600px; 
      }
      h1{
      font-weight:bold;
      margin-bottom:15px;
      color:rgb(241, 158, 103);
    }
        .contact-form label { 
          font-weight: 600; 
          margin-top: 10px; 
          display: block; 
          text-align: left; }
        .btn-submit { 
          background-color: rgb(241, 158, 103); 
          color: white; 
          border: none; 
          padding: 10px 20px; 
          width: 100%; 
          margin-top: 20px; 
        }
        .btn-submit:hover { 
          background-color: maroon; 
          color: white;
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
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="contact.php">Contact Us</a></li>
              <li class="nav-item dropdown">
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
      

      <section>
        <h1 class="text-center">Contact Us</h1>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db.php';

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $comments = $_POST['comments'];

            $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, comments) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $comments);

            if ($stmt->execute()) {
                echo "
                <div id='success-msg' class='alert alert-success shadow-lg'>
                    <strong>Success!</strong> Thank you, " . htmlspecialchars($name) . ". Message sent.
                </div>
                <script>
                    setTimeout(function() {
                        var msg = document.getElementById('success-msg');
                        if (msg) {
                            msg.style.transition = 'opacity 0.6s';
                            msg.style.opacity = '0';
                            setTimeout(function() { msg.remove(); }, 600);
                        }
                    }, 3000); // 3 seconds
                </script>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
            $conn->close();
        }
        ?>

        <p class="text-center text-muted">We’d love to hear from you. Send us a message below!</p>
        
        <form action="contact.php" method="post" class="contact-form">
            <label>Name*</label>
            <input type="text" name="name" class="form-control" required>

            <label>E-mail*</label>
            <input type="email" name="email" class="form-control" required>

            <label>Contact Number*</label>
            <input type="tel" name="phone" class="form-control" maxlength="11" required>

            <label>Comments/Suggestions*</label>
            <textarea name="comments" class="form-control" rows="4" required></textarea>

            <input type="submit" value="Send Message" class="btn btn-submit">
        </form>
    </section>
    

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
    
    <script src="bootstrap-5.3.8-examples/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>