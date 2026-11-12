<?php
class Employe
{
    public function __construct(
        public $matricule,
        public $nom,
        public $salaireBase
    ) {}

    public function calculerSalaire()
    {
        return $this->salaireBase;
    }

    public function getType()
    {
        return "Employe";
    }

    public function afficher()
    {
        echo $this->matricule . " | " . $this->nom . " | " . $this->getType() . " | " . $this->calculerSalaire() . " Ar\n";
    }
}

class Manager extends Employe
{
    public function __construct(
        $matricule, $nom, $salaireBase,
        public $prime
    ) {
        parent::__construct($matricule, $nom, $salaireBase);
    }

    public function calculerSalaire()
    {
        return parent::calculerSalaire() + $this->prime;
    }

    public function getType()
    {
        return "Manager";
    }
}

class Commercial extends Employe
{
    public function __construct(
        $matricule, $nom, $salaireBase,
        public $ventes,
        public $taux
    ) {
        parent::__construct($matricule, $nom, $salaireBase);
    }

    public function calculerSalaire()
    {
        return parent::calculerSalaire() + $this->ventes * $this->taux / 100;
    }

    public function getType()
    {
        return "Commercial";
    }
}

class Stagiaire extends Employe
{
    public function calculerSalaire()
    {
        return $this->salaireBase * 30 / 100;
    }

    public function getType()
    {
        return "Stagiaire";
    }
   
}

//  Programme principal
$e1 = new Employe("E01", "Rabe", 600000);
$m1 = new Manager("M01", "Rakoto", 1200000, 400000);
$c1 = new Commercial("C01", "Rasoa", 500000, 8000000, 5);
$c2 = new Commercial("C02", "Hery", 500000, 3000000, 5);
$e2 = new Employe("E02", "Fara", 650000);
$s1 = new Stagiaire("S01", "Tiana", 600000);

$personnel = [$e1, $m1, $c1, $c2, $e2, $s1];

echo "Matricule | Nom | Type | Salaire\n";
$masse = 0;
$nbCommerciaux = 0;
$mieuxPaye = $personnel[0];

foreach ($personnel as $emp) {
    $emp->afficher();
    $masse = $masse + $emp->calculerSalaire();

    if ($emp->getType() == "Commercial") {
        $nbCommerciaux = $nbCommerciaux + 1;
    }

    if ($emp->calculerSalaire() > $mieuxPaye->calculerSalaire()) {
        $mieuxPaye = $emp;
    }
}

echo "Masse salariale : " . $masse . " Ar\n";
echo "Nombre de commerciaux : " . $nbCommerciaux . "\n";
echo "Salaire le plus eleve : " . $mieuxPaye->nom . "\n";