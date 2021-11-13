<?php
class Tache
{
    private string $contenu;
    private string $date;
    private string $importance;                   //Rouge: Très important Orange: Moyennement important Vert: Pas inportant


    public function __construct(string $contenu, string $date, string $importance){
        $this->contenu=$contenu;
        $this->date=$date;
        $this->importance=$importance;
    }

    public function __toString(): string{
        $aRetourn = "Tache a faire : $this->contenu ".'<br>';
        $aRetourn = $aRetourn."Pour le : $this->date ".'<br>';
        $aRetourn = $aRetourn."Couleur : $this->importance ".'<br>'.'<br>';
        return $aRetourn;
    }

    public function getCouleur(): string{
        return $this->importance;
    }
}
?>
