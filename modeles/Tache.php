<?php
class Tache
{
    private int $idTache;
    private string $contenu;
    private string $date;
    private string $importance;                   //Rouge: Très important Orange: Moyennement important Vert: Pas inportant
    private int $isPublic;                     // pour que les visiteurs le voit ou pas
    private string $idListe;

    public function __construct(int $idTache, string $contenu, string $date, string $importance, int $isPublic, string $idListe){
        $this->idTache=$idTache;     //Auto increment idTache grâce à PHPMyAdmin
        $this->contenu=$contenu;
        $this->date=$date;
        $this->importance=$importance;
        $this->isPublic=$isPublic;
        $this->idListe = $idListe;
    }

    public function __toString(): string{
        $aRetourn = "Tache a faire : $this->contenu ".'<br>';
        $aRetourn = $aRetourn."Pour le : $this->date ".'<br>';
        //$aRetourn = $aRetourn."Identifiant : $this->idTache ".'<br>';
        //$aRetourn = $aRetourn."Importance : $this->importance ".'<br>';
        //$aRetourn = $aRetourn."est public ? : $this->isPublic".'<br>';
        //$aRetourn = $aRetourn."Liste : $this->idListe".'<br>'.'<br>';
        return $aRetourn;
    }

    public function getIdTache(): string{
        return $this->idTache;
    }

    public function getCouleur(): string{
        return $this->importance;
    }

    public function getContenu(): string{
        return $this->contenu;
    }

    public function setContenu($contenu){
        $this->contenu = $contenu;
    }

    public function getDate(): string{
        return $this->date;
    }

    public function getIsPublic(): string{
        return $this->isPublic;
    }

    public function getIdListe(): string{
        return $this->idListe;
    }
}
?>
