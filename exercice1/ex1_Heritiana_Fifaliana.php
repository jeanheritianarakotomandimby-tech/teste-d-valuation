<?php
class Produit
{
    public function __construct(
        public $nom,
        public $prix,
        public $quantite
    ) {}

    public function valeurStock()
    {
        return $this->prix * $this->quantite;
    }

    public function vendre($qte)
    {
        if ($qte <= $this->quantite) {
            $this->quantite = $this->quantite - $qte;
        } else {
            echo "Vente impossible : stock insuffisant pour " . $this->nom . "\n";
        }
    }

    public function afficher()
    {
        echo $this->nom . " | " . $this->prix . " Ar | " . $this->quantite . " | " . $this->valeurStock() . " Ar\n";
    }
}

// d) Programme principal
$riz = new Produit("Riz", 3500, 40);
$huile = new Produit("Huile", 9000, 12);
$sucre = new Produit("Sucre", 3800, 25);

$riz->vendre(15);
$huile->vendre(20);

$sucre->prix = 4200;

$produits = [$riz, $huile, $sucre];

echo "Nom | Prix | Quantite | Valeur stock\n";
$total = 0;
foreach ($produits as $p) {
    $p->afficher();
    $total = $total + $p->valeurStock();
}
echo "Valeur totale du stock : " . $total . " Ar\n";
