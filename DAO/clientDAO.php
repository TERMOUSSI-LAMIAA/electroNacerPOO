<?php
require_once('Model/connexion.php');
require_once('classes/client.php');

class ClientDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getClient()
    {
        $query = "SELECT * FROM clients";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $clients = array();
        foreach ($result as $row) {
            $clients[] = new Client($row["full_name"], $row["username"], $row["email"], $row["password"], $row["adresse"], $row["ville"], $row["phone"]);
        }
        return $clients;
    }
    public function getClientByUsername($username)
    {
        $query = "SELECT * FROM clients WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Client($result["full_name"], $result["username"], $result["email"], $result["password"], $result["adresse"], $result["ville"], $result["phone"]);
        } else {
            return null;
        }
    }

    public function insert_client($clnt)
    {
        $query = "INSERT INTO  `clients`(`full_name`, `username`, `email`, `password`, `adresse`, `ville`, `phone`) VALUES (:full_name, :username,:email,:password,:adresse,:ville,:phone)";

        $stmt = $this->db->prepare($query);

        $full_name = $clnt->getFullnom();
        $username = $clnt->getUsername();
        $email = $clnt->getEmail();
        $password = $clnt->getMdpCl();
        $adresse = $clnt->getAdresse();
        $ville = $clnt->getVille();
        $phone = $clnt->getNum_phone();

        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':phone', $phone);
        try {
            $stmt->execute();
            echo "Record inserted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function update_client($clnt)
    {
        $query = "UPDATE clients SET 
                  `full_name` = :full_name, 
                  `email` = :email,
                  `password` = :pass,
                  `adresse` = :adresse,
                  `ville` = :ville,
                  `phone` = :phone
                  WHERE `username` = :username";

        $stmt = $this->db->prepare($query);

        $full_name = $clnt->getFullnom();
        $username = $clnt->getUsername();
        $email = $clnt->getEmail();
        $pass = $clnt->getMdpCl();
        $adresse = $clnt->getAdresse();
        $ville = $clnt->getVille();
        $phone = $clnt->getNum_phone();

        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':phone', $phone);
        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
//insert
// $clnt = new Client('fullname1','us1', 'email@','pas1','adr1','vil1','0652124587');
// $clntDAO = new ClientDAO();
// $clntDAO->insert_client($clnt);
//updt
// $clnt = new Client('fullname71', 'us1', 'email@gmil.com', 'passss1', 'adr1', 'vil1', '0652124587');
// $clntDAO = new ClientDAO();
// $clntDAO->update_client($clnt);
