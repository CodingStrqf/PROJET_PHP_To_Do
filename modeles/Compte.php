<?php
require_once ("ListeTache.php");
class Compte
{
    private string $pseudo;
    private string $motPasse;
    private ListeTache $listeTaches;

    public function __construct(string $pseudo, string $motPasse)
    {
        $this->pseudo=$pseudo;
        $this->motPasse=$motPasse;
        $this->listeTaches = array();
    }

    public function getPseudo(): string{
        return $this->pseudo ;
    }

    public function getMotPasse(): string{
        return $this->motPasse ;
    }

    public function getConnexion(): int{
        return $this->connecter;
    }

    public function connexion(string $pseudo, string $motPasse, $tab): int{
        foreach ($tab as $value){
            if($value->getPseudo() == $pseudo){
                if($value->getMotPasse() == $motPasse){
                    return 1;
                }
            }
        }
        return 0;
    }
}