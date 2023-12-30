<?php
session_start();
include("connection.php");
$stmt = $conn->prepare("SELECT * FROM categories WHERE isHide = 0");
$stmt->execute();
$catgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_SESSION['client'])) {
    $client = $_SESSION['client'];
    $stmt1 = $conn->prepare("SELECT * FROM panier WHERE client_username = '$client'");
    $stmt1->execute();
    $nbrOfPanier = $stmt1->rowCount();
    $panier = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($panier);
    // echo '</pre>';

    $subTotal = 0;

    foreach ($panier as $item) {
        $ref = $item['product_ref'];
        $qnt = $item['qnt'];
        $stmt1 = $conn->prepare("SELECT * FROM products WHERE reference = '$ref'");
        $stmt1->execute();
        $product = $stmt1->fetch(PDO::FETCH_ASSOC);
        $subTotal += $product['prixOffre'] * $qnt;
    }

    if (isset($_POST['placeOrder'])) {
        $client = $_SESSION['client'];
        date_default_timezone_set('Africa/Casablanca');

        $cuurentDate = date("Y-m-d");
        $creatDate = date("Y-m-d H:i:s");
        $envoiDate = date("Y-m-d", strtotime($cuurentDate . "+1 day"));
        $livraisonDate = date("Y-m-d", strtotime($cuurentDate . "+10 days"));

        $sql = "INSERT INTO commande
		(client_username, envoiDate, livraisonDate, totalPrice)
		VALUES ('$client', '$envoiDate', '$livraisonDate', '$subTotal')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "SELECT command_id FROM commande WHERE client_username = '$client'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $command_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $id = $command_id[count($command_id) - 1]["command_id"]; /* Obtenir id de la derniere command */



        /* Ajouter les produits liée à la commande dans linecommand tableau */
        foreach ($panier as $item) {
            $refPro = $item["product_ref"];
            $quantity = $item["qnt"];
            $query = "INSERT INTO `linecommand` 
			(linecommand.command_id, linecommand.product_ref, linecommand.qnt)
			VALUES
			('$id', '$refPro', '$quantity')";
            $stmt1 = $conn->prepare($query);
            $stmt1->execute();
        }

        /* Vider le panier aprés la confirmation des commands */

        $sql = "DELETE FROM panier WHERE client_username = '$client'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("location: index.php");
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Checkout</title>

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
        <!-- HEADER -->
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

            </header>
            <!-- /HEADER -->

            <!-- NAVIGATION -->
            <nav id="navigation">
                <!-- container -->
                <div class="container">
                    <!-- responsive-nav -->
                    <div id="responsive-nav">
                        <!-- NAV -->
                        <ul class="main-nav nav navbar-nav">
                            <li><a class="li-padding" href="product.php">All Products</a></li>
                            <?php foreach ($catgs as $catg) { ?>
                                <li><a class="li-padding" href="product.php"><?php echo $catg['name'] ?></a></li>
                            <?php } ?>

                        </ul>
                        <!-- /NAV -->
                    </div>
                    <!-- /responsive-nav -->
                </div>
                <!-- /container -->
            </nav>
            <!-- /NAVIGATION -->

            <!-- BREADCRUMB -->
            <div id="breadcrumb" class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Checkout</h3>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /BREADCRUMB -->

            <!-- SECTION -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">

                        <div class="col-md-7">
                            <!-- Billing Details -->
                            <form action="" method="post">
                                <div class="billing-details">
                                    <div class="section-title">
                                        <h3 class="title">Billing address</h3>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="first-name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="last-name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="country" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="tel" name="tel" placeholder="Telephone">
                                    </div>

                                    <div class="form-group">
                                        <button class="primary-btn order-submit" type="submit" name="placeOrder">
                                            Place Order
                                        </button>
                                    </div>

                                </div>
                            </form>
                            <!-- /Billing Details -->


                        </div>

                        <!-- Order Details -->
                        <div class="col-md-5 order-details">
                            <div class="section-title text-center">
                                <h3 class="title">Your Order</h3>
                            </div>
                            <div class="order-summary">
                                <div class="order-col">
                                    <div><strong>PRODUCT</strong></div>
                                    <div><strong>TOTAL</strong></div>
                                </div>
                                <div class="order-products">
                                    <?php foreach ($panier as $item) : ?>
                                        <div class="order-col">
                                            <?php
                                            $ref = $item['product_ref'];
                                            $qnt = $item['qnt'];
                                            $stmt1 = $conn->prepare("SELECT * FROM products WHERE reference = '$ref'");
                                            $stmt1->execute();
                                            $product = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <div><?php echo $qnt . "x " . $product[0]['etiquette']; ?></div>
                                            <div><?php echo number_format($product[0]['prixOffre'] * $qnt, 2) . "DH"; ?></div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                                <div class="order-col">
                                    <div><strong>TOTAL</strong></div>
                                    <div><strong class="order-total"><?php echo number_format($subTotal, 2) . "DH"; ?></strong></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Order Details -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /SECTION -->



            <!-- FOOTER -->
            <footer id="footer">
                <!-- top footer -->
                <div class="section">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="footer">
                                    <h3 class="footer-title">About Us</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut.</p>
                                    <ul class="footer-links">
                                        <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                        <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="footer">
                                    <h3 class="footer-title">Categories</h3>
                                    <ul class="footer-links">
                                        <li><a href="#">Hot deals</a></li>
                                        <li><a href="#">Laptops</a></li>
                                        <li><a href="#">Smartphones</a></li>
                                        <li><a href="#">Cameras</a></li>
                                        <li><a href="#">Accessories</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="clearfix visible-xs"></div>

                            <div class="col-md-3 col-xs-6">
                                <div class="footer">
                                    <h3 class="footer-title">Information</h3>
                                    <ul class="footer-links">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Orders and Returns</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="footer">
                                    <h3 class="footer-title">Service</h3>
                                    <ul class="footer-links">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">View Cart</a></li>
                                        <li><a href="#">Wishlist</a></li>
                                        <li><a href="#">Track My Order</a></li>
                                        <li><a href="#">Help</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
                </div>
                <!-- /top footer -->
            </footer>
            <!-- /FOOTER -->

            <!-- jQuery Plugins -->
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/slick.min.js"></script>
            <script src="js/nouislider.min.js"></script>
            <script src="js/jquery.zoom.min.js"></script>
            <script src="js/main.js"></script>

    </body>

    </html>

<?php } else {
    header("Location: index.php");
    exit;
} ?>