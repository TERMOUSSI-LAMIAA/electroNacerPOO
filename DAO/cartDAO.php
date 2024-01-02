<?php
require_once(dirname(__FILE__) . '/../Model/connexion.php');
require_once(dirname(__FILE__) . '/../classes/ProduitClass.php');

class cartDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getItemsByClient($username)
    {
        $query = "SELECT c.qnt,p.* FROM panier c INNER JOIN products p on p.reference = c.product_ref WHERE c.client_username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $items = array();
        foreach ($result as $row) {
            $item = [];
            $item["product"] = new Produit($row["reference"], $row["etiquette"], $row["codeBarres"], $row["prixAchat"], $row["prixFinal"], $row["prixOffre"], $row["descpt"], $row["qntMin"], $row["qntStock"], $row["img"], $row["catg"]);
            $item["qnt"] = $row["qnt"];
            $items[] = $item;
        }
        return $items;
    }

    public function countCartItems($username, $ref = "")
    {
        $query = "SELECT SUM(qnt) as cart_count FROM panier WHERE client_username = :username";

        if ($ref != "") {
            $query .= " AND  product_ref = :ref";
        }

        $stmt = $this->db->prepare($query);

        if ($ref != "") {
            $stmt->bindParam(':ref', $ref);
        }

        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return isset($result[0]) ? $result[0]['cart_count'] : 0;
    }

    public function addToCart($username, $ref)
    {
        $count = $this->countCartItems($username, $ref);
        if ($count > 0) {
            $query = "UPDATE panier SET qnt = qnt + 1 WHERE client_username = :username  AND  product_ref = :ref";
        } else {
            $query = "INSERT INTO panier(client_username, product_ref, qnt) VALUES (:username, :ref, 1)";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':ref', $ref);
        $stmt->execute();

        return $this->countCartItems($username);
    }

    public function deletFromCart($username, $ref = "")
    {
        $query = "Delete FROM panier WHERE client_username = :username";

        if ($ref != "") {
            $query .= " AND  product_ref = :ref";
        }

        $stmt = $this->db->prepare($query);

        if ($ref != "") {
            $stmt->bindParam(':ref', $ref);
        }

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function updateCart($username, $ref, $qnt)
    {
        if ($qnt < 1) {
            $this->deletFromCart($username, $ref);
            return 0;
        }

        $query = "UPDATE panier SET qnt = :qnt WHERE client_username = :username  AND  product_ref = :ref";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':qnt', $qnt);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':ref', $ref);
        $stmt->execute();

        return $this->countCartItems($username);
    }
}
