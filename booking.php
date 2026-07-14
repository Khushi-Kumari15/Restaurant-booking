<?php

include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $guests = $_POST['guests'];
    $special_request = trim($_POST['special_request']);

    if (!empty($name) && !empty($phone) && !empty($email) && !empty($booking_date) && !empty($booking_time) && !empty($guests)) {

        $sql = "INSERT INTO bookings
        (name, phone, email, booking_date, booking_time, guests, special_request)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $name,
            $phone,
            $email,
            $booking_date,
            $booking_time,
            $guests,
            $special_request
        ]);

        $message = "✅ Table booked successfully!";
    } else {
        $message = "❌ Please fill all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Book Table</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

<div class="logo">🍽 Royal Restaurant</div>

<ul>
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="booking.php">Book Table</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>

</nav>

<section>

<h2 class="section-title">Book Your Table</h2>

<?php
if($message!=""){
echo "<p style='text-align:center;color:#FFD700;font-size:20px;'>$message</p>";
}
?>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="email" name="email" placeholder="Email Address" required>

<label>Booking Date</label>
<input type="date" name="booking_date" required>

<label>Booking Time</label>
<input type="time" name="booking_time" required>

<input type="number" name="guests" placeholder="Number of Guests" min="1" required>

<textarea
name="special_request"
rows="5"
placeholder="Special Request (Optional)"></textarea>

<button type="submit">
Book Now
</button>

</form>

</section>

<footer>

<p>
© 2026 Royal Restaurant Booking System | Developed By Khushi Kumari
</p>

</footer>

<script src="script.js"></script>

</body>
</html>