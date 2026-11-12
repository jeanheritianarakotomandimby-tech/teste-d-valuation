<?php
class CompteBancaire
{
    public function __construct(
        public $numero,
        public $titulaire,
        public $solde
    ) {}

    public function deposer($montant)
    {
        $this->solde = $this->solde + $montant;
    }

    public function retirer($montant)
    {
        if ($montant <= $this->solde) {
            $this->solde = $this->solde - $montant;
            return true;
        } else {
            echo "Retrait refuse sur " . $this->numero . " : solde insuffisant\n";
            return false;
        }
    }

    public function virer($montant, $destination)
    {
        if ($this->retirer($montant) == true) {
            $destination->deposer($montant);
        }
    }

    public function afficher()
    {
        echo $this->numero . " | " . $this->titulaire . " | " . $this->solde . " Ar\n";
    }
}

//  Programme principal
$c1 = new CompteBancaire("CPT-001", "Rakoto", 500000);
$c2 = new CompteBancaire("CPT-002", "Rasoa", 0);
$c3 = new CompteBancaire("CPT-003", "Randria", 120000);

$c2->deposer(200000);
$c1->retirer(150000);
$c3->retirer(300000);
$c1->virer(100000, $c2);
$c2->virer(50000, $c3);

$comptes = [$c1, $c2, $c3];

foreach ($comptes as $c) {
    $c->afficher();
}

$total = 0;
foreach ($comptes as $c) {
    $total = $total + $c->solde;
}

echo "Nombre de comptes : " . count($comptes) . "\n";
echo "Total des soldes : " . $total . " Ar\n";