<?php
require_once(dirname(__FILE__) . '/../Model/connexion.php');
require_once(dirname(__FILE__) . '/../classes/ProduitClass.php');

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

    public function getProduits($isHide = false)
    {
        $query = "SELECT * FROM products";

        if ($isHide) {
            $query .= " WHERE isHide = 1 ";
        } else {
            $query .= " WHERE isHide = 0 ";
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = array();
        foreach ($result as $row) {
            $products[] = new Produit($row["reference"], $row["etiquette"], $row["codeBarres"], $row["prixAchat"], $row["prixFinal"], $row["prixOffre"], $row["descpt"], $row["qntMin"], $row["qntStock"], $row["img"], $row["catg"]);
        }
        return $products;
    }


    public function getProduitsByEtiquette($etiquette)
    {
        $query = "SELECT * FROM products WHERE etiquette LIKE '%$etiquette%'";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = array();
        foreach ($result as $row) {
            $products[] = new Produit($row["reference"], $row["etiquette"], $row["codeBarres"], $row["prixAchat"], $row["prixFinal"], $row["prixOffre"], $row["descpt"], $row["qntMin"], $row["qntStock"], $row["img"], $row["catg"]);
        }
        return $products;
    }

    // public function insert_product($Product)
    // {
    //     $query = "INSERT INTO products (`reference`, `etiquette`, `descpt`, `codeBarres`, `img`, `prixAchat`, `prixFinal`, `prixOffre`, `qntMin`, `qntStock`, `catg`) 
    //               VALUES (:reference, :etiquette, :descpt, :codeBarres, :img, :prixAchat, :prixFinal, :prixOffre, :qntMin, :qntStock, :catg)";

    //     $stmt = $this->db->prepare($query);

    //     $reference = $Product->getRef();
    //     $etiquette = $Product->getEtqt();
    //     $descpt = $Product->getDesc();
    //     $codeBarres = $Product->getCodeBarre();
    //     $img = $Product->getImgProd();
    //     $prixAchat = $Product->getPrAch();
    //     $prixFinal = $Product->getPrFin();
    //     $prixOffre = $Product->getOffrePr();
    //     $qntMin = $Product->getQteMin();
    //     $qntStock = $Product->getQteStock();
    //     $catg = $Product->getCatg();

    //     $stmt->bindParam(':reference', $reference);
    //     $stmt->bindParam(':etiquette', $etiquette);
    //     $stmt->bindParam(':descpt', $descpt);
    //     $stmt->bindParam(':codeBarres', $codeBarres);
    //     $stmt->bindParam(':img', $img);
    //     $stmt->bindParam(':prixAchat', $prixAchat);
    //     $stmt->bindParam(':prixFinal', $prixFinal);
    //     $stmt->bindParam(':prixOffre', $prixOffre);
    //     $stmt->bindParam(':qntMin', $qntMin);
    //     $stmt->bindParam(':qntStock', $qntStock);
    //     $stmt->bindParam(':catg', $catg);

    //     try {
    //         $stmt->execute();
    //         echo "Record inserted successfully.";
    //     } catch (PDOException $e) {
    //         throw $e;
    //     }
    // }
    public function insertProduct($title, $codeBar, $prixAchat, $prixFinal, $desc, $qntMin, $qntStock, $img, $catg)
    {
        $stmt = $this->db->prepare("INSERT INTO 
            products(etiquette, codeBarres, prixAchat, prixFinal, prixOffre, descpt, qntMin, qntStock, img, catg)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $codeBar, $prixAchat, $prixFinal, $prixFinal, $desc, $qntMin, $qntStock, $img, $catg]);

    }
    // public function updateProduct($Product)
    // {
    //     $query = "UPDATE `products` SET 
    //               `etiquette` = :etiquette, 
    //               `descpt` = :descpt,
    //               `codeBarres` = :codeBarres,
    //               `img` = :img,
    //               `prixAchat` = :prixAchat,
    //               `prixFinal` = :prixFinal,
    //               `prixOffre` = :prixOffre,
    //               `qntMin` = :qntMin,
    //               `qntStock` = :qntStock,
    //               `catg` = :catg
    //               WHERE `reference` = :reference";

    //     $stmt = $this->db->prepare($query);

    //     $reference = $Product->getRef();
    //     $etiquette = $Product->getEtqt();
    //     $descpt = $Product->getDesc();
    //     $codeBarres = $Product->getCodeBarre();
    //     $img = $Product->getImgProd();
    //     $prixAchat = $Product->getPrAch();
    //     $prixFinal = $Product->getPrFin();
    //     $prixOffre = $Product->getOffrePr();
    //     $qntMin = $Product->getQteMin();
    //     $qntStock = $Product->getQteStock();
    //     $catg = $Product->getCatg();

    //     $stmt->bindParam(':reference', $reference);
    //     $stmt->bindParam(':etiquette', $etiquette);
    //     $stmt->bindParam(':descpt', $descpt);
    //     $stmt->bindParam(':codeBarres', $codeBarres);
    //     $stmt->bindParam(':img', $img);
    //     $stmt->bindParam(':prixAchat', $prixAchat);
    //     $stmt->bindParam(':prixFinal', $prixFinal);
    //     $stmt->bindParam(':prixOffre', $prixOffre);
    //     $stmt->bindParam(':qntMin', $qntMin);
    //     $stmt->bindParam(':qntStock', $qntStock);
    //     $stmt->bindParam(':catg', $catg);

    //     try {
    //         $stmt->execute();
    //         echo "Record updated successfully.";
    //     } catch (PDOException $e) {
    //         throw $e;
    //     }
    // }
    public function updateProduct($ref, $title, $prixAchat, $prixFinal, $desc, $qntMin, $qntStock, $catg, $img)
    {
        $query = "UPDATE `products` SET 
              `etiquette` = :title, 
              `descpt` = :desc,
              `prixAchat` = :prixAchat,
              `prixFinal` = :prixFinal,
              `qntMin` = :qntMin,
              `qntStock` = :qntStock,
              `catg` = :catg";

        // If an image is provided, include it in the update
        if (!empty($img)) {
            $query .= ", `img` = :img";
        }

        $query .= " WHERE `codeBarres` = :ref";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':ref', $ref);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':prixAchat', $prixAchat);
        $stmt->bindParam(':prixFinal', $prixFinal);
        $stmt->bindParam(':qntMin', $qntMin);
        $stmt->bindParam(':qntStock', $qntStock);
        $stmt->bindParam(':catg', $catg);

        // If an image is provided, bind its value
        if (!empty($img)) {
            $stmt->bindParam(':img', $img);
        }

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    // public function delete_product($id)
    // {
    //     $query = "UPDATE `products` SET `isHide` = 1 WHERE `reference` = :id";
    //     $stmt = $this->db->prepare($query);

    //     $stmt->bindParam(':id', $id);

    //     try {
    //         $stmt->execute();
    //         echo "Record deleted successfully.";
    //     } catch (PDOException $e) {
    //         throw $e;
    //     }
    // }
    public function hideProduct($etiquette)
    {
        try {
            $sql = "UPDATE products
                    SET isHide = 1
                    WHERE etiquette = :etiquette";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':etiquette', $etiquette);
            $stmt->execute();

            return true; // Success
        } catch (PDOException $e) {
            // Handle the exception or log the error
            return false; // Error
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
// $prDAO->updateProduct($pr);
//delete
// $prDAO = new ProduitDAO();
// $prDAO->delete_product(39);
// echo 'in';
