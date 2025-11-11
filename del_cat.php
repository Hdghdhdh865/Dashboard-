
<?php

require 'inc/CONFIG.php';
if (isset($_GET["id"])) {

    

    $stmt = $pdo->prepare("DELETE FROM `categoy` WHERE `cat_id` = ?");
    $stmt->execute([$_GET["id"]]);

    header("Location: category.php");
    exit();
}
?>



