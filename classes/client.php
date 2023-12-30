<?php
class Client
{
    private $username;
    private $fullnom;
    private $num_phone;
    private $adresse;
    private $email;
    private $ville;
    private $mdpCl;
    public function __construct($n, $user, $em, $mdp, $ad, $vil, $num)
    {
        $this->fullnom = $n;
        $this->username = $user;
        $this->email = $em;
        $this->mdpCl = $mdp;
        $this->adresse = $ad;
        $this->ville = $vil;
        $this->num_phone = $num;
    }



    public function getNum_phone()
    {
        return $this->num_phone;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getVille()
    {
        return $this->ville;
    }
    public function getMdpCl()
    {
        return $this->mdpCl;
    }
    public function getFullnom()
    {
        return $this->fullnom;
    }
    public function getUsername()
    {
        return $this->username;
    }
}
