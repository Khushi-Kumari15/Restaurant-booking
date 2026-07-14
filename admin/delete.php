<?php
// Project By: Khushi kumari
// Registered Email: bgpkbyadav@gmail.com

include "../db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");

    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>