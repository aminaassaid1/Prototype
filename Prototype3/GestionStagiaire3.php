<?php
include 'connection3.php';
include __DIR__ . '/stagiaire3.php';

class GestionStagiaire {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createStagiaire($nom, $prenom, $cne, $id_ville) {
        try {
            if ($nom === null || $prenom === null || $cne === null) {
                throw new Exception("Stagiaire properties cannot be null.");
            }

            $sql = "INSERT INTO personne (nom, prenom, CNE, id_ville) VALUES (:nom, :prenom, :cne, :id_ville)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':cne', $cne);
            $stmt->bindParam(':id_ville', $id_ville);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error creating Stagiaire: " . $e->getMessage());
        }
    }

    public function getStagiaireById($id) {
        try {
            $sql = "SELECT personne.id, personne.nom, personne.prenom, personne.CNE, ville.nom_ville
                    FROM personne
                    JOIN ville ON personne.id_ville = ville.id
                    WHERE personne.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function updateStagiaire($id, $nom, $CNE, $ville) {
        try {
            $sql = "UPDATE personne SET nom = :nom, CNE = :CNE, id_ville = :ville WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':CNE', $CNE);
            $stmt->bindParam(':ville', $ville);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function deleteStagiaire($id) {
        try {
            $sql = "DELETE FROM personne WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

$gestionStagiaire = new GestionStagiaire($conn);

?>
