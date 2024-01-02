<?php
session_start();

require_once(dirname(__FILE__) . '/../DAO/clientDAO.php');
$clients = (new ClientDAO())->getClients();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>



    </style>
</head>

<body>
    <?php include("head.php") ?>

    <section class="dashboard">
        <?php
        include("sideBar.html");
        ?>

        <div class="col-md-10">
            <h1>Liste des Clients
                <?php echo "(" . count($clients) . " clients)" ?>
            </h1>
            <table>
                <tr>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>is valid</th>
                    <th>update valid</th>
                </tr>

                <?php
                foreach ($clients as $client) {
                    echo "<tr>";
                    echo "<td>" . $client->getFullnom() . "</td>";
                    echo "<td>" . $client->getEmail() . "</td>";
                    echo "<td>" . $client->getUsername() . "</td>";
                    echo "<td>" . ($client->getIsValid() ? "Valider" : "Non Valider") . "</td>";

                    echo "<td><button type='button' class='btn btn-primary' onclick='updateValidClient(`" . $client->getUsername() . "`," . ($client->getIsValid() ? 0 : 1) . ")'>" . ($client->getIsValid() ? "UnValid" : "Valid") . "</button></td>";
                    echo "</tr>";
                }

                ?>

            </table>
        </div>
    </section>
    <script src="../js/jquery.min.js"></script>
    <script>
        function updateValidClient(username, valid) {
            $.get(`ajaxConn.php?action=updateValidClient&username=${username}&valid=${valid}`, function (data) {
                // document.querySelector("#panier > div.qty").innerHTML = data.count;
                location.reload()

            }, "json")
                .fail(function () {
                    console.log("error");
                });
        }
    </script>

</body>

</html>