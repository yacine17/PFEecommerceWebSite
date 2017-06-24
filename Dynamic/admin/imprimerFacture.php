<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 05/05/2017
 * Time: 21:05
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
require '..\app\fpdf.php';
class FacturePDF extends FPDF{

    function Header()
    {
        $this->SetFont('Arial', 'BI', 24);
        //$this->Cell(80);
        $this->cMargin = 0;
        $this->Cell(15,8,'Lib', 0, 0, 'R');
        $this->setTextColor(255, 134, 0);
        $this->Cell(20, 8, 'Tech');
        $this->cMargin = 1;
        $this->SetFont('courier', '', 10);
        $this->SetTextColor(0);
        $this->Ln();
        $str = iconv('UTF-8', 'windows-1252', '\'De la culture à revendre\'');
        $this->Cell(15, 8, $str, 0, 1);
        $this->Ln();
    }

    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function loadFacture(\app\classes\Facture $facture)
    {
        $data = array();
        foreach ($facture->getCommande()->getProduitCommandes() as $produitCommande)
        {
            /**
             * @var $produitCommande \app\classes\ProduitCommande
             */
            $pr = array();
            $pr[] = $produitCommande->getProduit()->getReferenceProduit();
            $pr[] = $produitCommande->getProduit()->getLibelle();
            $pr[] = $produitCommande->getQuantite();
            $pr[] = $produitCommande->getProduit()->getPrix();
            $pr[] = ($produitCommande->getQuantite() * $produitCommande->getProduit()->getPrix());
            $data[] = $pr;
        }
        return $data;

    }

    function ImprovedTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(30, 80, 25, 25, 30);
        // En-tête
        for($i=0; $i<5; $i++)
        {
            $str = iconv('UTF-8', 'windows-1252', $header[$i]);
            $this->Cell($w[$i], 7, $str, 1, 0, 'C');
        }

        $this->Ln();
        // Données
        foreach($data as $row)
        {
            $str = iconv('UTF-8', 'windows-1252', $row[0]);
            $this->Cell($w[0],6,$str,'LR');
            $str = iconv('UTF-8', 'windows-1252', $row[1]);
            $this->Cell($w[1],6,$str,'LR');
            $str = iconv('UTF-8', 'windows-1252', $row[2]);
            $this->Cell($w[2],6,number_format($str,0,',',' '),'LR',0,'R');
            $str = iconv('UTF-8', 'windows-1252', $row[3]);
            $this->Cell($w[3],6,number_format($str,0,',',' '),'LR',0,'R');
            $str = iconv('UTF-8', 'windows-1252', $row[4]);
            $this->Cell($w[4],6,number_format($str,0,',',' '),'LR',0,'R');
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }

    public function totalFacture(\app\classes\Facture $facture)
    {

        $this->Ln(5);
        $this->SetX(-80);
        $this->Cell(35, 8, 'Total HT: ', 'LTR');
        $this->Cell(35, 8, $facture->getCommande()->PrixTTC() . ' DA', 'TR', 1, 'R');
        $this->SetX(-80);
        $this->Cell(35, 8, 'TVA: ', 'LR');
        $this->Cell(35, 8, '0 DA', 'R', 1, 'R');
        $this->SetX(-80);
        $this->Cell(35, 8, 'Total TTC :', 'LRB');
        $this->Cell(35, 8, $facture->getCommande()->PrixTTC() . ' DA', 'RB', 1, 'R');
    }

}
if (isset($_GET['id']))
{
    $factureDb = new \app\table\FactureTable(\app\Config::getInstance()->getDatabase());
    $idFacture = (ctype_digit($_GET['id'])) ? $_GET['id'] : null;
    $facture = $factureDb->findById($idFacture);
    if ($facture)
    {
        $pdf = new FacturePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('courier', '', 12);
        $str = iconv('UTF-8', 'windows-1252', 'Facture N°: ' . str_pad($facture->getNumeroFacture(), 10, '0', STR_PAD_LEFT));
        $pdf->Cell(15, 8, $str, 0, 1);
        $pdf->Cell(15, 8, 'Tlemcen, le: ' . date('d/m/Y', strtotime($facture->getDate())), 0, 1);
        $str = 'Client: ' . $facture->getCommande()->getClient()->getNom() . ' ' . $facture->getCommande()->getClient()->getPrenom();
        $str = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Cell(15, 8, $str, 0, 1);
        $str = 'Adresse: ' . $facture->getCommande()->getAdresseLivraison();
        $str = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Cell(15, 8, $str, 0, 1);
        $data = $pdf->loadFacture($facture);
        $header = array('Reference', 'Libelle', 'Quantité', 'Prix UHT', 'Montant HT');
        $pdf->Ln();
        $pdf->ImprovedTable($header, $data);
        $pdf->totalFacture($facture);
        $pdf->Output();
    }
}
