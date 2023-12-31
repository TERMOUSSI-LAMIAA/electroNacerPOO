<?php
session_start();
require_once(dirname(__FILE__) . '/../DAO/ProduitDAO.php');
require_once(dirname(__FILE__) . '/../DAO/categorieDAO.php');
require_once(dirname(__FILE__) . '/../classes/ProduitClass.php');


$productDAO = new ProduitDAO();


$ctegorieDAO = new CategorieDAO();
$catgs = $ctegorieDAO->getCategorie();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hideProduct = $_POST["hided"];

    // if ($product->hideProduct($hideProduct)) {
    //     echo "Product hidden successfully!";
    // } else {
    //     echo "Error hiding the product.";
    // }

    header("Refresh: 1; url=hideProduct.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>



    </style>
</head>

<body>
    <?php include("head.php") ?>

    <section class="dashboard">
        <?php
        include("sideBar.html");
        ?>
        <div class="col-md-10">

            <h1>Masquer une Produit</h1>
            <?php if (count($catgs) > 0) { ?>
                <form action="" method="post" class="container">
                    <div class="mb-3">
                        <label for="catg" class="form-label">Choisir un Produit</label>
                        <select name="hided" id="" class="form-control">
                            <?php
                            foreach ($catgs as $catg) {
                                $temp = $catg["name"];
                                $stmt = $conn->prepare("SELECT * FROM products WHERE catg = '$temp' AND isHide = 0");
                                $stmt->execute();
                                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if (count($res) > 0) {
                                    echo "<optgroup label=" . $catg["name"] . ">" . $catg["name"];
                                }
                                foreach ($product as $item) {
                                    if ($item["catg"] === $catg["name"]) {
                                        echo "<option>" . $item["etiquette"] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary my-2" value="Masquer">
                </form>
            <?php } else {
                echo "<p class='all-valid'>Tous les produits sont masqués.</p>";
            } ?>

        </div>
    </section>
</body>

</html>