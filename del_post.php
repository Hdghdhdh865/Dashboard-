<?php require 'inc/CONFIG.php';
if (isset($_GET["id"])) {

    

    $stmt = $pdo->prepare("DELETE FROM `posts` WHERE post_id = ?");
    $stmt->execute([$_GET["id"]]);

    header("Location: display_all_post.php");
    exit();
}

?>