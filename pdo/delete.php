
<?php

require_once "../includes/pdodbinit.php";

if (isset($_GET['id'])) {
    $deleteData = $pdo->prepare("DELETE FROM computers WHERE ComputerID = :id");
    $deleteData->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $deleteData->execute();
    header("Location: index.php");
    exit;
}

?>