<?php
require_once('Model/connexion.php');
require_once('classes/user.php');

class UserDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getUser()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $users = array();
        foreach ($result as $row) {
            $users[] = new User($row["email"], $row["username"], $row["pass"], $row["state"], $row["role"]);
        }
        return $users;
    }

    public function insertUser($user)
    {
        $query = "INSERT INTO `users`(`email`, `username`, `pass`, `state`, `role`)
                VALUES (:email, :username,:pass,:state,:role)";

        $stmt = $this->db->prepare($query);

        $email = $user->getEmailU();
        $username = $user->getLoginU();
        $pass = $user->getMdpU();
        $state = $user->getState();
        $role = $user->getRole();

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':role', $role);
        try {
            $stmt->execute();
            echo "Record inserted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getUserByUsername($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result["email"], $result["username"], $result["pass"], $result["state"], $result["role"]);
        } else {
            return null;
        }
    }
    public function updateUser($user)
    {
        $query = "UPDATE `users` SET 
                  `username` = :username,
                  `pass` = :pass,
                  `state` = :state,
                  `role` = :role
                  WHERE `email` = :email";


        $stmt = $this->db->prepare($query);

        $email = $user->getEmailU();
        $username = $user->getLoginU();
        $pass = $user->getMdpU();
        $state = $user->getState();
        $role = $user->getRole();

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':role', $role);
        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}


//insert
// $usr = new User('email@','user1', 'pas1',0, 0);
// $usrDAO = new UserDAO();
// $usrDAO->insertUser($usr);
//updt
// $usr = new User('email@','user1111', 'pas1',1, 0);
// $usrDAO = new UserDAO();
// $usrDAO->updateUser($usr);
