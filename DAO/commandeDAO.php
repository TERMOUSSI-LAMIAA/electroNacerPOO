<?php
require_once(dirname(__FILE__) . '/../Model/connexion.php');
require_once(dirname(__FILE__) . '/../classes/commande.php');
require_once(dirname(__FILE__) . '/../DAO/cartDAO.php');

class CommandDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getCommandes()
    {
        $query = "SELECT * FROM commande";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $commandes = array();
        foreach ($result as $row) {
            $commandes[] = new Commande($row["command_id"], $row["createDate"], $row["envoiDate"], $row["livraisonDate"], $row["totalPrice"], $row["client_username"]);
        }
        return $commandes;
    }

    public function getCommandesByClient($username, $last = false)
    {
        $query = "SELECT * FROM commande WHERE client_username = :username ";
        if ($last) {
            $query .= " ORDER BY command_id LIMIT 1 ";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $commandes = array();
        foreach ($result as $row) {
            $commandes[] = new Commande($row["command_id"], $row["createDate"], $row["envoiDate"], $row["livraisonDate"], $row["totalPrice"], $row["client_username"]);
        }
        return $commandes;
    }

    public function saveCommande($client, $panier)
    {
        $subTotal = array_reduce($panier, function ($sum, $item) {
            return $sum + ($item["qnt"] * $item["product"]->getOffrePr());
        }, 0);

        $envoiDate = date("Y-m-d", strtotime(date("Y-m-d") . "+1 day"));
        $livraisonDate = date("Y-m-d", strtotime(date("Y-m-d") . "+10 days"));
        $query = "INSERT INTO commande
		(client_username, envoiDate, livraisonDate, totalPrice)
		VALUES (:username, :envoiDate , :livraisonDate , :subTotal)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':username', $client);
        $stmt->bindParam(':envoiDate', $envoiDate);
        $stmt->bindParam(':livraisonDate', $livraisonDate);
        $stmt->bindParam(':subTotal', $subTotal); // HAS LEMIT RANGE
        $stmt->execute();

        // get last command id
        $cmd = $this->getCommandesByClient($client, true);
        if (isset($cmd[0])) {
            $cmd = $cmd[0];
        } else {
            return false;
        }

        foreach ($panier as $item) {
            $query = "INSERT INTO `linecommand` 
                (linecommand.command_id, linecommand.product_ref, linecommand.qnt)
                VALUES
                (:command_id, :product_ref, :qnt)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':command_id', $cmd->getIdCmd());
            $stmt->bindParam(':product_ref', $item["product"]->getRef());
            $stmt->bindParam(':qnt', $item["qnt"]);
            $stmt->execute();
        }
        return true;
    }
}
