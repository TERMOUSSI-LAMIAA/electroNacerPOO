<?php
session_start();
include("connection.php");


if (isset($_SESSION['client'])) {
    $client = $_SESSION["client"];
    $stmt = $conn->prepare("SELECT * FROM panier WHERE client_username = '$client'");
    $stmt->execute();
    $panier = $stmt->fetchAll();

    $stmt1 = $conn->prepare("SELECT * FROM products");
    $stmt1->execute();
    $products = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($products);
    // echo '</pre>';

    $subTotal = 0;

    $stmt2 = $conn->prepare("SELECT * FROM panier WHERE client_username = '$client'");
    $stmt2->execute();
    $nbrOfPanier = $stmt2->rowCount();


?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Shopping Cart</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"">
        <link href=" https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/cart.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Electro - HTML Ecommerce Template</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css" />
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>


        <header>
            <header>
                <div id="top-header">
                    <div class="container">
                        <ul class="header-links pull-left">
                            <li><a href="#"><i class="fa fa-phone"></i> +212642653021</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> class404@electro.com</a></li>
                            <li><a href="#"><i class="fa fa-map-marker"></i> Youcode Safi</a></li>
                        </ul>
                        <ul class="header-links pull-right">
                            <?php if (isset($_SESSION['client'])) { ?>
                                <li><a href="#"><i class="fa fa-user-o"></i> <?php echo $_SESSION['client'] ?></a></li>
                                <li><a href="logoutClient.php"><i class="fa fa-user-o"></i> Logout</a></li>
                            <?php } else { ?>
                                <li><a href="loginClient.php"><i class="fa fa-user-o"></i> Login</a></li>

                            <?php } ?>
                        </ul>
                        </ul>
                    </div>
                </div>

                <!-- MAIN HEADER -->
                <div id="header">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                            <!-- LOGO -->
                            <div class="col-md-9">
                                <div class="header-logo">
                                    <a href="index.php" class="logo">
                                        <img src="./img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- /LOGO -->
                            <div class="col-md-3 clearfix">
                                <div class="header-ctn">
                                    <?php if (isset($_SESSION['client'])) { ?>
                                        <div>
                                            <a href="cart.php" id="panier">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Your Cart</span>
                                                <div class="qty"><?php echo $nbrOfPanier ?></div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- Menu Toogle -->
                                    <div class="menu-toggle">
                                        <a href="#">
                                            <i class="fa fa-bars"></i>
                                            <span>Menu</span>
                                        </a>
                                    </div>
                                    <!-- /Menu Toogle -->
                                </div>
                            </div>

                            <!-- SEARCH BAR -->

                            <!-- /SEARCH BAR -->

                            <!-- ACCOUNT -->

                            <!-- /MAIN HEADER -->
            </header>


            <main class="page">
                <section class="shopping-cart dark">
                    <div class="container">
                        <div class="block-heading">
                            <h2>Shopping Cart</h2>
                            <p>Our Shopping Cart page is designed with your convenience in mind. It's a user-friendly space
                                where you have full control over your selections and can proceed confidently to the next steps
                                of your online shopping journey. Happy shopping!</p>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="items" id="items">

                                        <?php foreach ($panier as $item) :
                                            $client = $item['client_username'];
                                            $ref = $item['product_ref'];
                                            $qnt = $item['qnt'];
                                            $stmt1 = $conn->prepare("SELECT * FROM products WHERE reference = '$ref'");
                                            $stmt1->execute();
                                            $product = $stmt1->fetchAll(PDO::FETCH_ASSOC); ?>
                                            <div class="product">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img class="img-fluid mx-auto d-block image" src="<?php echo "admin/" . $product[0]['img']; ?>">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="info">
                                                            <div class="row">
                                                                <div class="col-md-5 product-name">
                                                                    <div class="product-name">
                                                                        <a href="productPage.php?ref=<?php echo $product[0]['reference']; ?>"><?php echo $product[0]['etiquette']; ?></a>
                                                                        <div class="product-info">
                                                                            <div class="mb-3">
                                                                                <?php echo $product[0]['descpt']; ?>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 quantity">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input id="quantity" type="number" data-client="<?php echo $item['client_username'] ?>" data-product="<?php echo $item['product_ref'] ?>" onchange="Addqnt(this)" value="<?php echo $item['qnt']; ?>" class="form-control quantity-input">
                                                                </div>
                                                                <div class="col-md-3 price">
                                                                    <span id="<?php echo $item['product_ref'] ?>"><?php echo number_format($product[0]['prixOffre'] * $qnt, 2) . "DH";
                                                                                                                    $subTotal += $product[0]['prixOffre'] * $qnt;  ?></span>
                                                                </div>
                                                                <div class="col-md-4 delete">
                                                                    <button type="button" class="btn btn-danger btn-block" data-client="<?php echo $item['client_username'] ?>" data-product="<?php echo $item['product_ref'] ?>" onclick="deleteFromPanier(this)">
                                                                        Delete
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="summary">
                                        <h3>Summary</h3>
                                        <div class="summary-item"><span class="text">Total</span><span class="price"><?php echo number_format($subTotal, 2) . "DH"; ?></span>
                                        </div>
                                        <a href="checkout.php" class="text-white"><button type="button" class="btn btn-success btn-lg btn-block" onclick="addCommand()">Confirm the order</button></a>
                                        <a href="product.php" class="text-white"><button type="button" class="btn btn-warning  btn-lg btn-block">Continue my shopping</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function Addqnt(input) {
            let client = input.getAttribute('data-client');
            let refProduct = input.getAttribute('data-product');
            let myRequest = new XMLHttpRequest();
            myRequest.open("GET", "ajax.php?client=" + client +
                "&refProduct=" + refProduct + "&qnt=" + input.value, true);
            // myRequest.onreadystatechange = function() {
            //     if (this.readyState === 4 && this.status === 200) {
            //         console.log(this.responseText);
            //     }
            // }
            myRequest.send();

        }

        function deleteFromPanier(input) {
            let client = input.getAttribute('data-client');
            let refProduct = input.getAttribute('data-product');
            let myRequest = new XMLHttpRequest();
            myRequest.open("GET", "ajax.php?clientRemove=" + client + "&refProductRemove=" + refProduct, true);
            myRequest.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.responseText === "1") {
                        location.reload();
                    }
                }
            }
            myRequest.send();
        }


        // let qnt_buttons = document.querySelectorAll("#")
    </script>

    </body>

    </html>
<?php } else {
    echo '<h1>Please Login Your Account</h1>';
    header("Refresh: 1; url=loginClient.php");
} ?>