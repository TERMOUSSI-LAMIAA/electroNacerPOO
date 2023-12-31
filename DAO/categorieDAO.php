<?php
require_once('Model/connexion.php');
require_once('classes/categorie.php');

class CategorieDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getCategorie()
    {
        $query = "SELECT * FROM categories  WHERE isHide = 0 ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $categories = array();
        foreach ($result as $row) {
            $categories[] = new Categorie($row["name"], $row["descrt"], $row["img"]);
        }
        return $categories;
    }

    // public function getCategories($name="", $isHide = false)
    // {
    //     $query = "SELECT * FROM categories  WHERE isHide = $isHide ";

    //     if($name != "" )
    //     $query .= " And name = :name ";

    //     $stmt = $this->db->prepare($query);

    //     if($name != "" )
    //         $stmt->bindParam(':name', $name);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
    //     $categories = array();
    //     foreach ($result as $row) {
    //         $categories[] = new Categorie($row["name"], $row["descrt"], $row["img"]);
    //     }
    //     return $categories;
    // }

    public function insertCategory($catg)
    {
        $query = "INSERT INTO   categories (`name`, `descrt`, `img`)
                VALUES (:name, :descrt,:img)";

        $stmt = $this->db->prepare($query);

        $name = $catg->getNomCat();
        $desc = $catg->getDesc();
        $img = $catg->getPhotoCat();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':descrt', $desc);
        $stmt->bindParam(':img', $img);
        try {
            $stmt->execute();
            echo "Record inserted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateCategory($catg)
    {
        $query = "UPDATE categories SET 
                  `descrt` = :descrt, 
                  `img` = :img
                  WHERE `name` = :name";
        $stmt = $this->db->prepare($query);

        $name = $catg->getNomCat();
        $desc = $catg->getDesc();
        $img = $catg->getPhotoCat();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':descrt', $desc);
        $stmt->bindParam(':img', $img);

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function deleteCategory($name)
    {
        $query = "UPDATE categories SET `isHide` = 1 WHERE `name` = :name";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':name', $name);

        try {
            $stmt->execute();
            echo "Record deleted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

//insert
// $cat = new Categorie('catname','desccc', 'img/');
// $catDAO = new CategorieDAO();
// $catDAO->insertCategory($cat);
//updt
// $cat= new Categorie('catname','descccnew', 'img1/');
// $catDAO = new CategorieDAO();
// $catDAO->updateCategory($cat);
//delete
// $catDAO = new CategorieDAO();
// $catDAO->deleteCategory('catname');


// echo'in';
