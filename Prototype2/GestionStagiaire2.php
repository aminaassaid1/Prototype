<?php
global $conn;
include __DIR__ . '/connection2.php';
include __DIR__ . '/stagiare2.php';

class GestionStagiaire {
    private $conn;


    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createStagiaire($nom, $cne) {
        try {
            if ($nom === null || $cne === null) {
                throw new Exception("Stagiaire properties cannot be null.");
            }

            $sql = "INSERT INTO personne (nom, CNE) VALUES (:nom, :cne)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':cne', $cne);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error creating Stagiaire: " . $e->getMessage());
        }
    }




    public function getStagiaireById($id) {
        try {
            $sql = "SELECT * FROM personne WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function updateStagiaire($id, $nom, $cne) {
        try {
            $sql = "UPDATE personne SET nom = :nom, CNE = :cne WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':cne', $cne);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
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
