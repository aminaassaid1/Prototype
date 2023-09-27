<?php
include "connection.php";
include "./gestionStagiare.php";
$GestionStagiaire = new GestionStagiaire();
$StagiaresData = $GestionStagiaire->getStagiaire();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Stagiaire List</title>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">List of Stagiaires</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NOM</th>
            <th scope="col">CNE</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($StagiaresData as $index => $Stagiaire) { ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= $Stagiaire->getNom() ? $Stagiaire->getNom() : "N/A" ?></td>
                <td><?= $Stagiaire->getCNE() ? $Stagiaire->getCNE() : "N/A" ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>



