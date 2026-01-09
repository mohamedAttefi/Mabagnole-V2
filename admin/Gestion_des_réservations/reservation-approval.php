<?php 
include "../../classes/Reservation.php";
$id = $_GET["id"];
$result = Reservation::updateStatus($id, "confirmee");

if($result){
    header("location: reservations.php");
    exit;
}
?>