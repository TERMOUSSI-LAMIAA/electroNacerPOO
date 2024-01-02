<?php
class Categorie implements JsonSerializable
{
    private $nomCat;
    private $desc;
    private $photoCat;
    public function __construct($n, $des, $pht)
    {
        $this->nomCat = $n;
        $this->desc = $des;
        $this->photoCat = $pht;
    }
    public function getNomCat()
    {
        return $this->nomCat;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getPhotoCat()
    {
        return $this->photoCat;
    }


    public function jsonSerialize()
    {
        return [
            'nomCat' => $this->getNomCat(),
            'desc' => $this->getDesc(),
            'photoCat' => $this->getPhotoCat(),
        ];
    }
}
