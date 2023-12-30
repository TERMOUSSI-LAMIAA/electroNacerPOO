<?php
class User
{
    private $emailU;
    private $loginU;
    private $mdpU;
    private $state;
    private $role;
    public function __construct($em, $log, $mdp, $st, $rol)
    {
        $this->emailU = $em;
        $this->loginU = $log;
        $this->mdpU = $mdp;
        $this->state = $st;
        $this->role = $rol;
    }
    public function getEmailU()
    {
        return $this->emailU;
    }
    public function getLoginU()
    {
        return $this->loginU;
    }
    public function getMdpU()
    {
        return $this->mdpU;
    }
    public function getState()
    {
        return $this->state;
    }
    public function getRole()
    {
        return $this->role;
    }
}
