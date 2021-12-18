<?php

class UserControler
{
    public function __construct($id)
    {
        if($id == null){
            $_SESSION['login'] = null;
            require_once("vues/AffichagePasCo.php");
        }else{
            $_SESSION['login'] = $id;
            require_once("vues/AffichageConnection.php");
        }
    }
}