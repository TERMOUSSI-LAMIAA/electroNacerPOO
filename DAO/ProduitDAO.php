<?php
require_once('C:\xampp\htdocs\ElectroNacerPoo\Model\connexion.php');
require_once('C:\xampp\htdocs\ElectroNacerPoo\classes\ProduitClass.php');

class ProduitDAO
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getProduit()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = array();
        foreach ($result as $row) {
            $products[] = new Produit($row["reference"], $row["etiquette"], $row["codeBarres"], $row["prixAchat"], $row["prixFinal"], $row["prixOffre"], $row["descpt"], $row["qntMin"], $row["qntStock"], $row["img"], $row["catg"]);
        }
        return $products;
    }

    public function insert_product($Product)
    {
        $query = "INSERT INTO products (`reference`, `etiquette`, `descpt`, `codeBarres`, `img`, `prixAchat`, `prixFinal`, `prixOffre`, `qntMin`, `qntStock`, `catg`) 
                  VALUES (:reference, :etiquette, :descpt, :codeBarres, :img, :prixAchat, :prixFinal, :prixOffre, :qntMin, :qntStock, :catg)";
    
        $stmt = $this->db->prepare($query);
    
        $reference = $Product->getRef();
        $etiquette = $Product->getEtqt();
        $descpt = $Product->getDesc();
        $codeBarres = $Product->getCode_barre();
        $img = $Product->getImgProd();
        $prixAchat = $Product->getPr_ach();
        $prixFinal = $Product->getPr_fin();
        $prixOffre = $Product->getOffre_pr();
        $qntMin = $Product->getQte_min();
        $qntStock = $Product->getQte_stock();
        $catg = $Product->getCatg();
    
        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);
        $stmt->bindParam(':codeBarres', $codeBarres);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':prixAchat', $prixAchat);
        $stmt->bindParam(':prixFinal', $prixFinal);
        $stmt->bindParam(':prixOffre', $prixOffre);
        $stmt->bindParam(':qntMin', $qntMin);
        $stmt->bindParam(':qntStock', $qntStock);
        $stmt->bindParam(':catg', $catg);
    
        try {
            $stmt->execute();
            echo "Record inserted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update_product($Product)
    {
        $query = "UPDATE `products` SET 
                  `etiquette` = :etiquette, 
                  `descpt` = :descpt,
                  `codeBarres` = :codeBarres,
                  `img` = :img,
                  `prixAchat` = :prixAchat,
                  `prixFinal` = :prixFinal,
                  `prixOffre` = :prixOffre,
                  `qntMin` = :qntMin,
                  `qntStock` = :qntStock,
                  `catg` = :catg
                  WHERE `reference` = :reference";
    
        $stmt = $this->db->prepare($query);
    
        $reference = $Product->getRef();
        $etiquette = $Product->getEtqt();
        $descpt = $Product->getDesc();
        $codeBarres = $Product->getCode_barre();
        $img = $Product->getImgProd();
        $prixAchat = $Product->getPr_ach();
        $prixFinal = $Product->getPr_fin();
        $prixOffre = $Product->getOffre_pr();
        $qntMin = $Product->getQte_min();
        $qntStock = $Product->getQte_stock();
        $catg = $Product->getCatg();
    
        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);
        $stmt->bindParam(':codeBarres', $codeBarres);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':prixAchat', $prixAchat);
        $stmt->bindParam(':prixFinal', $prixFinal);
        $stmt->bindParam(':prixOffre', $prixOffre);
        $stmt->bindParam(':qntMin', $qntMin);
        $stmt->bindParam(':qntStock', $qntStock);
        $stmt->bindParam(':catg', $catg);
    
        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
    public function delete_product($id)
    {
        $query = "UPDATE `products` SET `isHide` = 1 WHERE `reference` = :id";
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':id', $id);
    
        try {
            $stmt->execute();
            echo "Record deleted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
//order!!!!!!!!!!!!!!!!!!!
//insert
// $pr = new Produit('','produit1', '8565265', 200, 400, 300, 'desc1', 5, 90, 'img1/', 'Robot');
// $prDAO = new ProduitDAO();
// $prDAO->insert_product($pr);
//updt
// $pr=new Produit(40,'produit1', '8565265', 200, 400, 350, 'desc1111', 5, 70, 'img1/', 'Robot');
// $prDAO = new ProduitDAO();
// $prDAO->update_product($pr);
//delete
// $prDAO = new ProduitDAO();
// $prDAO->delete_product(39);
// echo 'in';
?>