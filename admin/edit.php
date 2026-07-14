<?php
// Project By: Khushi kumari
// Registered Email: bgpkbyadav@gmail.com

include "../db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id=?");
$stmt->execute([$id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$booking) {
    die("Booking not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $guests = $_POST['guests'];
    $special_request = $_POST['special_request'];
    $status = $_POST['status'];

    $update = $pdo->prepare("UPDATE bookings SET
        name=?,
        phone=?,
        email=?,
        booking_date=?,
        booking_time=?,
        guests=?,
        special_request=?,
        status=?
        WHERE id=?");

    $update->execute([
        $name,
        $phone,
        $email,
        $booking_date,
        $booking_time,
        $guests,
        $special_request,
        $status,
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Booking</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<nav>
<div class="logo">🍽 Edit Booking</div>

<ul>
<li><a href="index.php">Dashboard</a></li>
<li><a href="../index.php">Home</a></li>
</ul>

</nav>

<section>

<h2 class="section-title">Update Booking</h2>

<form method="POST">

<input type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>

<input type="text" name="phone" value="<?= htmlspecialchars($booking['phone']) ?>" required>

<input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>

<label>Booking Date</label>
<input type="date" name="booking_date" value="<?= $booking['booking_date'] ?>" required>

<label>Booking Time</label>
<input type="time" name="booking_time" value="<?= $booking['booking_time'] ?>" required>

<input type="number" name="guests" value="<?= $booking['guests'] ?>" min="1" required>

<textarea name="special_request" rows="4"><?= htmlspecialchars($booking['special_request']) ?></textarea>

<label>Status</label>

<select name="status">

<option value="Pending" <?= $booking['status']=="Pending"?"selected":"" ?>>Pending</option>

<option value="Confirmed" <?= $booking['status']=="Confirmed"?"selected":"" ?>>Confirmed</option>

<option value="Cancelled" <?= $booking['status']=="Cancelled"?"selected":"" ?>>Cancelled</option>

</select>

<button type="submit">Update Booking</button>

</form>

</section>

<footer>
<p>© 2026 Royal Restaurant Booking System</p>
</footer>

</body>
</html>