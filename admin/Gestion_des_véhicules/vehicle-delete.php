<?php
include "../../classes/Vehicle.php";

$id = $_GET["id"];
$resultat = Vehicle::deleteVehicle($id);
if($resultat){
    header("location: vehicles.php");
    exit;
}
else{
    echo "error";
}
?>