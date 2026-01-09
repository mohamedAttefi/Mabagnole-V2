<?php 
include "../../classes/Client.php";

$id = $_GET["id"];
Client::updateStatut(1, $id);
header("location: users.php");
exit;
?>