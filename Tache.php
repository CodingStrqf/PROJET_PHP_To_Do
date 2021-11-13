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
        return "$this->contenu à faire pour le $this->date, est de niveau d'importance $this->importance";
    }
}
?>