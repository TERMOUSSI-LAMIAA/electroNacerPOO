<?php
session_start();
require_once 'C:\xampp\htdocs\ElectroNacerPoo\DAO\categorieDAO.php';
$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');

// $stmt = $conn->prepare('SELECT * FROM categories WHERE isHide = 0');
// $stmt->execute();
// $catgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cat = new CategorieDAO();
$catgs = $cat->getCategorie();

$stmt1 = $conn->prepare('SELECT * FROM products WHERE isHide = 0');
$stmt1->execute();
$product = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM users");
$stmt2->execute();
$users = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$categories = json_encode($catgs);
$products = json_encode($product);


if (isset($_GET['table'])) {
    $table = $_GET['table'];
    //echo $$str;
    switch ($table) {
        case 'products':
            echo $products;
            break;
        case 'categories':
            echo $categories;
            break;

        default:
            # code...
            break;
    }
}

if (isset($_GET['liveSearch'])) {
    $search = $_GET['liveSearch'];
    if ($search != "") {
        $stmt2 = $conn->prepare("SELECT * FROM products WHERE etiquette LIKE '%$search%'");
        $stmt2->execute();
        $searchedProducts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchedProducts);
    }
}



// echo '<pre>';
// print_r($result);
// echo '</pre>';
