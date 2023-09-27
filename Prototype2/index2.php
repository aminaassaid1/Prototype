<?php
include "connection2.php"; // Include the correct file "connection2.php"
include "GestionStagiaire2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stagiaire List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Stagiaire List</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php


        $sql = "SELECT s.id, p.nom, s.email, s.password FROM stagiaire s
        INNER JOIN personne p ON s.id_personne = p.id";

        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                // Add buttons for actions (Edit and Delete)
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>";
                echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm ml-2'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Stagiaires found.</td></tr>";
        }
        $conn = null;
        ?>
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
