
<?php
require_once "../includes/dbinit.php";

if (isset($_GET['id'])) {
    $deleteData = $conn->prepare("DELETE FROM computers WHERE ComputerID = ?");
    $deleteData->bind_param("i", $_GET['id']);
    $deleteData->execute();
    header("Location: index.php");
    exit;
}
?>
