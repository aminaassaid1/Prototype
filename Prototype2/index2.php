<?php
include "connection2.php";
include "GestionStagiaire2.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["update"])) {
        $id = $_POST["edit-id"];
        $nom = $_POST["edit-nom"];
        $CNE = $_POST["edit-CNE"];


    }
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
</head>
<body>
<div class="container">
    <h2>Stagiaire List</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>CNE</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Define the SQL query
        $sql = "SELECT * FROM personne";

        // Execute the query
        $result = $conn->query($sql);

        if ($result && $result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['CNE'] . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-primary toggleModalBtn' data-bs-toggle='modal'
                    data-bs-target='#editModal'
                    data-id='" . $row['id'] . "'
                    data-nom='" . $row['nom'] . "'
                    data-CNE='" . $row['CNE'] . "'>Edit</button>";
                echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm ml-2'>Delete</a>";
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
                    <br>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
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
    $(document).ready(function() {
        $(".toggleModalBtn").click(function() {
            var id = $(this).data("id");
            var nom = $(this).data("nom");
            var CNE = $(this).data("CNE");

            $("#edit-id").val(id);
            $("#edit-nom").val(nom);
            $("#edit-CNE").val(CNE);
        });

        <?php if ($StagiaireDetails) { ?>
        $("#edit-id").val(<?php echo $StagiaireDetails['id']; ?>);
        $("#edit-nom").val("<?php echo $StagiaireDetails['nom']; ?>");
        $("#edit-CNE").val("<?php echo $StagiaireDetails['CNE']; ?>");
        <?php } ?>
    });
</script>



</body>
</html>
