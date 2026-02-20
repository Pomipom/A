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
    h2{
      color: rgb(195, 140, 103);
      font-weight: 600;
    }
    .abt-pic{
        width: 100%;
        height: auto;
        border-radius: 15px;
    }
    .abt-info{
      margin-top: 2%;
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
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
              <li class="nav-item dropdown">
                
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
    <section>
    <div class="about-section">
        <h1 class="text-center">About Pochi's Bake Shop</h1>
        <img class="abt-pic" src="image/4.png" alt="Pochi's Bake Shop">
    </div>

    <div class="abt-info">
      <h2>Our Story</h2>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis delectus nemo, consequuntur officia eos officiis autem recusandae, aliquid earum repellat beatae, rem ex dolore quibusdam id illum! Sint, necessitatibus! Quas?</p>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur animi, ad beatae facere ducimus omnis. Itaque, ullam, eaque, aliquam qui nisi laborum mollitia odio odit ducimus veniam nemo dicta quidem!</p>
    </div>
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