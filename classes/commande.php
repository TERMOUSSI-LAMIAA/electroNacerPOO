<?php
class Commande
{
    private $idCmd;
    private $createDate;
    private $envoiDate;
    private $livDate;
    private $totPrice;
    private $clntUsername;
    public function __construct($id, $cd, $ed, $ld, $tot, $Clname)
    {
        $this->idCmd = $id;
        $this->createDate = $cd;
        $this->envoiDate = $ed;
        $this->livDate = $ld;
        $this->totPrice = $tot;
        $this->clntUsername = $Clname;
    } 
    public function getIdCmd()
    {
        return $this->idCmd;
    }
    public function getCreateDate()
    {
        return $this->createDate;
    }
    public function getEnvoiDate()
    {
        return $this->envoiDate;
    }
    public function getLivDate()
    {
        return $this->livDate;
    }
    public function getTotPrice()
    {
        return $this->totPrice;
    }
    public function getClntUsername()
    {
        return $this->clntUsername;
    }
}
?>