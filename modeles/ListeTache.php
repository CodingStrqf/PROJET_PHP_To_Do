<?php
// les liste de taches apparaissent pour tous le monde, mais les taches en privé n'apparaitront que pour l'utilisateur qui l'a créé
require_once("Tache.php");

class ListeTache
{
    private string $idListe;
    private string $nom;
    private Tache $taches;

    public function __construct(Compte $c, string $s)
    {
        $this->idListe = $c->pseudo+$s;
        $this->c = $c;
        $this->nom = $s;
        $this->taches = array();
    }

    public function add(Tache $t){
        $this->taches = $t
        array_push($this->listeTache,$t);
    }

}