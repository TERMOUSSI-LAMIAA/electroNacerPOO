<?php
include('ajaxConn.php');


$stmt1 = $conn->prepare("SELECT * FROM categories WHERE isHide = 1");
$stmt1->execute();
$res = $stmt1->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hideProduct = $_POST["hided"];
    $sql1 = "UPDATE categories
        SET isHide = 0
        WHERE name = '$hideProduct'
    ";
    $stmt2 = $conn->prepare($sql1);
    $stmt2->execute();

    $stmt3 = $conn->prepare("UPDATE products SET isHide = 0 WHERE catg = '$hideProduct'");
    $stmt3->execute();

    header("Refresh: 1; url=afficheCatgMasquer.php");
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
        <!-- </div> -->
        <!-- </div> -->



        <div class="col-md-10">
            <h1>Afficher une Produit masqué</h1>
            <?php
            if (count($res) > 0) {
                ?>
                <form action="" method="post" class="container">
                    <div class="mb-3">
                        <label for="catg" class="form-label">Choisir une categorie</label>
                        <select name="hided" id="" class="form-control">
                            <?php


                            foreach ($res as $row) {
                                echo "<option>" . $row["name"] . "</option>";
                            }


                            ?>
                        </select>
                    </div>



                    <input type="submit" class="btn btn-primary my-2" value="Afficher">
                </form>
            <?php } else {
                echo "<p class='all-valid'>Tous les categories sont affichés.</p>";
            } ?>
        </div>
    </section>

</body>

</html>