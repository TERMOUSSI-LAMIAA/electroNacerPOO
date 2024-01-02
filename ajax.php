<?php
session_start();
require_once(dirname(__FILE__) . '/DAO/cartDAO.php');

$cartDAO = new CartDAO();
$client = $_SESSION['client']["username"];

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'deletFromCart':
            echo $cartDAO->deletFromCart($client, $_GET['ref']);
            break;
        case 'addToCart':
            $count = $cartDAO->addToCart($client, $_GET['ref']);
            echo json_encode([
                "count" =>  $count
            ]);
            break;
        case 'updateCart':
            $count = $cartDAO->updateCart($client, $_GET['ref'], $_GET['qnt']);
            echo json_encode([
                "count" =>  $count
            ]);
            break;

        default:
            break;
    }
}
