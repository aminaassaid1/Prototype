<?php
include 'connection.php';
include 'stagiaire.php';

class GestionStagiaire {
    private $conn; // Define the $conn property

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getStagiaire() {
        $stmt = $this->conn->prepare("SELECT * FROM personne");
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stagiairesData = [];

        foreach ($stagiaires as $stagiaire) {
            $GestionStagiaire = new Stagiaire();
            $GestionStagiaire->setId($stagiaire['Id']);
            $GestionStagiaire->setNom($stagiaire['Nom']);
            $GestionStagiaire->setCNE($stagiaire['CNE']);
            array_push($stagiairesData, $GestionStagiaire);
        }

        return $stagiairesData;
    }
}
