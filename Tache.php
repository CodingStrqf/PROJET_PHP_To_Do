<?php
class Tache
{
    private string $contenu;
    private string $date;
    private string $importance;                   //Rouge: Très important Orange: Moyennement important Vert: Pas inportant
    private int $estPublique;                  // pour que les visiteurs le voit ou pas

    public function __construct(string $contenu, string $date, string $importance, int $estPublique){
        $this->contenu=$contenu;
        $this->date=$date;

        if($importance == 'rouge'){
            $this->importance='#FF0000';
        }else{
            if ($importance == 'orange'){
                $this->importance='#FFA600';
            }else{
                $this->importance='#00FF94';
            }
        }
        $this->estPublique=$estPublique;
    }

    public function __toString(): string{
        $aRetourn = "Tache a faire : $this->contenu ".'<br>';
        $aRetourn = $aRetourn."Pour le : $this->date ".'<br>';
        //$aRetourn = $aRetourn."Couleur : $this->importance ".'<br>';
        $aRetourn = $aRetourn."est public ? : $this->estPublique".'<br>'.'<br>';
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
