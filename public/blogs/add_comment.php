<?php
include "../../classes/BlogComment.php";
session_start();
if(!isset($_SESSION["user_id"])){
    header("location: ../login.php");
    exit;
}



$user_id = $_SESSION["user_id"];
$content = $_POST["content"];
$id = $_POST["article_id"];
$data = ["article_id" => $id, "user_id" => $user_id, "content" => $content];
$resultat = BlogComment::addComment($data);
if ($resultat) {
    header("location: blog-article.php");
    exit;
}
