<?php 
include "../../classes/Review.php";
session_start();
$user_id = $_POST["user_id"];
$reservation_id = $_POST["reservation_id"];
$vehicule_id = $_POST["vehicule_id"];
$note = $_POST["note"];
$comment = $_POST["comment"];

echo $user_id ." ". $reservation_id." ". $vehicule_id." ". $note." ". $comment;
$Review = new Review(null, $user_id, $vehicule_id, $reservation_id, $note, $comment, null);
$Review->create();