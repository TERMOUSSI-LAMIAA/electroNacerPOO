<?php
class Produit implements JsonSerializable
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
    private $catg;

    public function __construct($r, $et, $cdbr, $pa, $pf, $ofp, $des, $qmin, $qst, $img, $cat)
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
        $this->catg = $cat;
    }

    public function getRef()
    {
        return $this->ref;
    }
    public function getEtqt()
    {
        return $this->etqt;
    }
    public function getCodeBarre()
    {
        return $this->code_barre;
    }
    public function getPrAch()
    {
        return $this->pr_ach;
    }
    public function getPrFin()
    {
        return $this->pr_fin;
    }
    public function getOffrePr()
    {
        return $this->offre_pr;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getQteMin()
    {
        return $this->qte_min;
    }
    public function getQteStock()
    {
        return $this->qte_stock;
    }
    public function getImgProd()
    {
        return $this->imgProd;
    }
    public function getCatg()
    {
        return $this->catg;
    }

    public function jsonSerialize()
    {
        return [
            'ref' => $this->getRef(),
            'etqt' => $this->getEtqt(),
            'codeBarre' => $this->getCodeBarre(),
            'prAch' => $this->getPrAch(),
            'prFin' => $this->getPrFin(),
            'offrePr' => $this->getOffrePr(),
            'desc' => $this->getDesc(),
            'qteMin' => $this->getQteMin(),
            'qteStock' => $this->getQteStock(),
            'imgProd' => $this->getImgProd(),
            'catg' => $this->getCatg(),
        ];
    }
}
