<?php
class Tache
{
    private int $idTache;
    private string $contenu;
    private string $date;
    private string $importance;                   //Rouge: Très important Orange: Moyennement important Vert: Pas inportant
    private int $isPublic;                     // pour que les visiteurs le voit ou pas

    public function __construct(string $contenu, string $date, string $importance, int $isPublic){
        $this->idTache=0;     //Auto increment idTache grâce à PHPMyAdmin
        $this->contenu=$contenu;
        $this->date=$date;

        if($importance == '3'){
            $this->importance='#FF0000';
        }else{
            if ($importance == '2'){
                $this->importance='#FFA600';
            }else{
                $this->importance='#00FF94';
            }
        }
        $this->isPublic=$isPublic;
    }

    public function __toString(): string{
        $aRetourn = "Tache a faire : $this->contenu ".'<br>';
        $aRetourn = $aRetourn."Pour le : $this->date ".'<br>';
        $aRetourn = $aRetourn."Importance : $this->importance ".'<br>';
        $aRetourn = $aRetourn."est public ? : $this->isPublic".'<br>'.'<br>';
        return $aRetourn;
    }

    public function getCouleur(): string{
        return $this->importance;
    }

    public function getContenu(): string{
        return $this->contenu;
    }
}
?>
