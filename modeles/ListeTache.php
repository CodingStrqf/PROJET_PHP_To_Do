<?php
// les liste de taches apparaissent pour tous le monde, mais les taches en privé n'apparaitront que pour l'utilisateur qui l'a créé
require_once("Tache.php");

class ListeTache
{
    private string $idListe;
    private string $nom;
    private array $taches;
    private string $idUtilisateur;

    public function __construct(string $nom, string $idUtilisateur)
    {
        $this->idListe = $idUtilisateur.$nom;
        $this->idUtilisateur = $idUtilisateur;
        $this->nom = $nom;
        $this->taches = array();
    }

//    public function add(Tache $t){
//        $this->taches = $t
//        array_push($this->listeTache,$t);
//    }
    /**
     * @return string
     */
    public function getIdListe(): string
    {
        return $this->idListe;
    }
}