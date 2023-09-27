<?php
include __DIR__ . '/connection2.php';
include __DIR__ . '/stagiare2.php';

class GestionStagiaire {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createStagiaire(Stagiaire $stagiaire) {
        try {
            $sql = "INSERT INTO stagiaire (nom, CNE) VALUES (:nom, :cne)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $stagiaire->getNom());
            $stmt->bindParam(':cne', $stagiaire->getCNE());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getStagiaireById($id) {
        try {
            $sql = "SELECT * FROM stagiaire WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function updateStagiaire(Stagiaire $stagiaire) {
        try {
            $sql = "UPDATE stagiaire SET nom = :nom, CNE = :cne WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $stagiaire->getNom());
            $stmt->bindParam(':cne', $stagiaire->getCNE());
            $stmt->bindParam(':id', $stagiaire->getId());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteStagiaire($id) {
        try {
            $sql = "DELETE FROM stagiaire WHERE id = :id";
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
