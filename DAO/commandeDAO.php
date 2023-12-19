<?php
require_once('../Model/connexion.php');
require_once('../classes/commande.php');

class CommandDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getCommande()
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







}







?>