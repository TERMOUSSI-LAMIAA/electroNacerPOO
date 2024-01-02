<?php
require_once(dirname(__FILE__) . '/../DAO/categorieDAO.php');
require_once(dirname(__FILE__) . '/../DAO/userDAO.php');
require_once(dirname(__FILE__) . '/../DAO/ProduitDAO.php');
require_once(dirname(__FILE__) . '/../DAO/clientDAO.php');


function getProducts()
{
    $produitDAO = new ProduitDAO();
    return json_encode($produitDAO->getProduits());
}


function getCategories()
{
    $categorieDAO = new CategorieDAO();
    return json_encode($categorieDAO->getCategorie());
}


function getUsers()
{
    $userDAO = new UserDAO();
    return json_encode($userDAO->getUser());
}

function updateValidClient($username, $valid)
{
    (new ClientDAO())->updateClientValid($username, $valid);
}


function search($search)
{
    $produitDAO = new ProduitDAO();
    return json_encode($produitDAO->getProduitsByEtiquette($search));
}

if (isset($_GET['table'])) {
    $table = $_GET['table'];
    //echo $$str;
    switch ($table) {
        case 'products':
            echo getProducts();
            break;

        case 'categories':
            echo getCategories();
            break;

        default:
            echo "[]";
            break;
    }
}

if (isset($_GET['liveSearch'])) {
    echo search($_GET['liveSearch']);
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    //echo $$str;
    switch ($action) {
        case 'updateValidClient':
            echo updateValidClient($_GET['username'], $_GET['valid']);
            break;

        default:
            echo "[]";
            break;
    }
}