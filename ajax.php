<?php
session_start();
$conn = new PDO('mysql:host=localhost;dbname=electronacerpoo', 'root', '');
if (isset($_GET['ref'])) {
    $client = $_SESSION['client']["username"];
    $ref = $_GET['ref'];

    $stmt = $conn->prepare("SELECT qnt FROM panier WHERE client_username = '$client' AND product_ref = '$ref'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $qnt = 1;
        $stmt1 = $conn->prepare("INSERT INTO panier(client_username, product_ref, qnt) VALUES ('$client', '$ref', 1)");
        $stmt1->execute();
    } else {
        $qnt = $result[0]['qnt'] + 1;
        $stmt1 = $conn->prepare("UPDATE panier SET qnt = '$qnt' WHERE product_ref = '$ref'");
        $stmt1->execute();
    }
    echo $qnt;
}

if (isset($_GET["in_panier"])) {
    $client = $_SESSION['client'];
    $ref = $_GET['in_panier'];
    $stmt = $conn->prepare("SELECT qnt FROM panier WHERE client_username = '$client' AND product_ref = '$ref'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        echo 0;
    } else {
        print_r($result[0]['qnt']);
    }
}

if (isset($_GET["client"]) && isset($_GET["refProduct"]) && isset($_GET["qnt"])) {
    $client2 = $_GET["client"];
    $ref = $_GET["refProduct"];
    $qnt = $_GET["qnt"];
    if ($qnt > 0) {
        $stmt2 = $conn->prepare("UPDATE panier SET qnt = '$qnt' WHERE client_username = '$client2' AND product_ref = '$ref'");
        $stmt2->execute();
    } elseif ($qnt === 0) {
        $stmt2 = $conn->prepare("DELETE FROM panier WHERE client_username = '$client2' AND product_ref = '$ref'");
        $stmt2->execute();
    }
}

if (isset($_GET["clientRemove"]) && isset($_GET["refProductRemove"])) {
    $client = $_GET["clientRemove"];
    $ref = $_GET["refProductRemove"];
    $stmt3 = $conn->prepare("DELETE FROM panier WHERE client_username = '$client' AND product_ref = '$ref'");
    $stmt3->execute();
    echo true;
}
