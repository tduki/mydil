<?php
require('../lib/fpdf.php');
include 'db_connexion.php';  

$materielId = $_GET['materiel_id'];
$dateDebut = $_GET['date_debut'];
$dateFin = $_GET['date_fin'];

// Récupérer le nom de l'appareil
$queryAppareil = "SELECT nom_materiel FROM materiel WHERE id = :materiel_id";
$stmtAppareil = $pdo->prepare($queryAppareil);
$stmtAppareil->execute(['materiel_id' => $materielId]);
$materiel = $stmtAppareil->fetch(PDO::FETCH_ASSOC);

// Si l'appareil n'est pas trouvé, on met un message d'erreur
if (!$materiel) {
    die("Appareil non trouvé.");
}

$nomMateriel = $materiel['nom_materiel'];

// Récupérer l'historique des réservations
$query = "
    SELECT 
        hr.date_debut, 
        hr.date_fin, 
        hr.raison, 
        identifiants.nom, 
        identifiants.prenom 
    FROM historique_reservation hr
    JOIN identifiants ON hr.fk_personne = identifiants.id
    WHERE hr.fk_materiel = :materiel_id
    AND hr.date_debut >= :date_debut
    AND hr.date_fin <= :date_fin
    ORDER BY hr.date_debut DESC
";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'materiel_id' => $materielId,
    'date_debut' => $dateDebut,
    'date_fin' => $dateFin
]);

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Créer le PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Titre du PDF
$pdf->Cell(0, 10, 'Historique des reservations', 0, 1, 'C');
$pdf->Ln(10);

// Ajouter les détails de l'appareil (nom au lieu de l'ID)
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Historique de l'appareil : $nomMateriel", 0, 1);
$pdf->Ln(5);

// Ajouter les réservations
foreach ($reservations as $reservation) {
    $pdf->Cell(0, 10, "Reservation par : " . $reservation['nom'] . " " . $reservation['prenom'], 0, 1);
    $pdf->Cell(0, 10, "Du : " . $reservation['date_debut'] . " au " . $reservation['date_fin'], 0, 1);
    $pdf->Cell(0, 10, "Raison : " . $reservation['raison'], 0, 1);
    $pdf->Ln(5);
}

$pdf->Output('D', "Historique_Appareil_$nomMateriel.pdf"); // Téléchargement direct
