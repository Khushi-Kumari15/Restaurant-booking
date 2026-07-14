<?php
// Project By: Khushi kumari
// Registered Email: bgpkbyadav@gmail.com

include "../db.php";

$search = "";

if(isset($_GET['search'])){
    $search = trim($_GET['search']);

    $stmt = $pdo->prepare("SELECT * FROM bookings
    WHERE name LIKE ? OR phone LIKE ?
    ORDER BY id DESC");

    $stmt->execute(["%$search%","%$search%"]);

}else{

    $stmt = $pdo->query("SELECT * FROM bookings ORDER BY id DESC");

}

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($bookings);
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<nav>

<div class="logo">
🍽 Admin Dashboard
</div>

<ul>

<li><a href="../index.php">Home</a></li>

<li><a href="../booking.php">Booking</a></li>

</ul>

</nav>

<section>

<h2 class="section-title">

Restaurant Booking Dashboard

</h2>

<div class="card-container">

<div class="card">

<h3>Total Bookings</h3>

<h1><?php echo $total; ?></h1>

</div>

</div>

<br>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search by Name or Phone"
value="<?php echo $search; ?>">

<button type="submit">

Search

</button>

</form>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Phone</th>

<th>Date</th>

<th>Time</th>

<th>Guests</th>

<th>Status</th>

<th>Action</th>

</tr>

<?php

foreach($bookings as $row){

?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['name']; ?></td>

<td><?= $row['phone']; ?></td>

<td><?= $row['booking_date']; ?></td>

<td><?= $row['booking_time']; ?></td>

<td><?= $row['guests']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a class="btn" href="edit.php?id=<?= $row['id']; ?>">

Edit

</a>

<a class="btn"

href="delete.php?id=<?= $row['id']; ?>"

onclick="return confirm('Delete this booking?')">

Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

</section>

<footer>

<p>

© 2026 Royal Restaurant Booking System

</p>

</footer>

</body>

</html>