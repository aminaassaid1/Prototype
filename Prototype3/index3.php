<?php
global $conn;
include  "GestionStagiaire3.php";
include "connection3.php";

    $stagiaire = new GestionStagiaire($conn);

    if($stagiaire){
        echo "yes";
    }else{
        echo "non";
    }

if (isset($_POST["update"])) {
    $id = $_POST["edit-id"];
    $nom = $_POST["edit-nom"];
    $CNE = $_POST["edit-CNE"];
    $ville = $_POST["edit-ville"];
    $stagiaire->updateStagiaire($id, $nom, $CNE, $ville);
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete-id"];
        $stagiaire->deleteStagiaire($id);
    } elseif (isset($_POST["add"])) {
        $nom = $_POST["nom"];
        $CNE = $_POST["cne"];
        $ville = $_POST["ville"];
    $id_ville = $stagiaire->getVilleIdByName($ville);
    $stagiaire->createStagiaire($nom, $CNE, $ville, $id_ville);

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stagiaire List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles3.css">

</head>
<body>
<div class="container">
    <h2>Stagiaire List</h2>
    <div>
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addVehicleModal">Add Stagiaires</button>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>CNE</th>
            <th>Ville</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Define the SQL query_
        $sql = "SELECT personne.*, ville.nom_ville
            FROM personne
            JOIN ville ON personne.id_ville = ville.id";

        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Fetch the results using a while loop
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result && count($result) > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['CNE'] . "</td>";
                echo "<td>" . $row['nom_ville'] . "</td>";
                echo "<td>";
                echo "<button type='button' onclick='btnEdit(this)' class='btn btn-primary toggleModalBtn' data-bs-toggle='modal'
                  data-bs-target='#editModal'
                  data-id='" . $row['id'] . "'
                  data-nom='" . $row['nom'] . "'
                  data-CNE='" . $row['CNE'] . "'
                  data-ville='" . $row['nom_ville'] . "'>Edit</button>";
                echo "<button type='button' class='btn btn-danger deleteInTable' data-bs-toggle='modal'
                  data-bs-target='#deleteVehicleModal'
                  data-id='" . $row['id'] . "'>Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Stagiaires found.</td></tr>";
        }
        ?>



        </tbody>
    </table>
</div>


<!-- Add  Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleModalLabel">Add Stagiaire </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add  form -->
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="cne" class="form-label">CNE:</label>
                        <input type="text" class="form-control" id="cne" name="cne" required>
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModal">Edit Stagiaire</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" id="edit-id" name="edit-id">
                    <label for="edit-nom">Nom:</label>
                    <input type="text" name="edit-nom" id="edit-nom" required>
                    <br>
                    <label for="edit-CNE">CNE:</label>
                    <input type="text" name="edit-CNE" id="edit-CNE" required>
                    <label for="edit-CNE">Ville:</label>
                    <input type="text" name="edit-ville" id="edit-ville" required>
                    <br>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteVehicleModalLabel">Delete Stagiaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Stagiaire?</p>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" id="delete-id" name="delete-id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(".deleteInTable").click(function () {
            var id = $(this).data("id");
            $("#delete-id").val(id);
        });
    });
</script>
<script>
    function btnEdit(Button) {
        var id = Button.getAttribute('data-id');
        var nom = Button.getAttribute('data-nom');
        var cne = Button.getAttribute('data-CNE');
        var ville = Button.getAttribute('data-ville');

        var inputNom = document.querySelector('#edit-nom');
        var inputCNE = document.querySelector('#edit-CNE');
        var inputID = document.querySelector('#edit-id');
        var inputVille = document.querySelector('#edit-ville');

        inputNom.value = nom;
        inputCNE.value = cne;
        inputID.value = id;
        inputVille.value = ville;
    }

</script>


</body>
</html>
