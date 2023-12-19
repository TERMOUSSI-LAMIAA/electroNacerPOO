<?php
class Produit
{
    private $ref;
    private $etqt;
    private $code_barre;
    private $pr_ach;
    private $pr_fin;
    private $offre_pr;
    private $desc;
    private $qte_min;
    private $qte_stock;
    private $imgProd;
    private $Catg;

    public function __construct($r, $et, $cdbr, $pa, $pf, $ofp, $des, $qmin, $qst, $img,$cat)
    {
        $this->ref = $r;
        $this->etqt = $et;
        $this->code_barre = $cdbr;
        $this->pr_ach = $pa;
        $this->pr_fin = $pf;
        $this->offre_pr = $ofp;
        $this->desc = $des;
        $this->qte_min = $qmin;
        $this->qte_stock = $qst;
        $this->imgProd = $img;
        $this->Catg= $cat;
    }

    public function getRef()
    {
        return $this->ref;
    }
    public function getEtqt()
    {
        return $this->etqt;
    }
    public function getCode_barre()
    {
        return $this->code_barre;
    }
    public function getPr_ach()
    {
        return $this->pr_ach;
    }
    public function getPr_fin()
    {
        return $this->pr_fin;
    }
    public function getOffre_pr()
    {
        return $this->offre_pr;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getQte_min()
    {
        return $this->qte_min;
    }
    public function getQte_stock()
    {
        return $this->qte_stock;
    }
    public function getImgProd()
    {
        return $this->imgProd;
    }
    public function getCatg()
    {
        return $this->Catg;
    }
}
?>