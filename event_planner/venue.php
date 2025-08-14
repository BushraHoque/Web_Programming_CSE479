<?php
session_start();
include "db.php";  // Database connection

// Fetch venues from the database
$sql = "SELECT * FROM venues";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Venues - Ring Event Planner</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Navbar -->
<header class="head">
  <a href="index.php" class="logo"><img class="logo1" src="Image/logo1.png" alt="logo" /></a>
  <nav class="navbar">
    <a href="index.php" class="active">Home</a>
    <a href="services.php">Services</a>
    <a href="vendors.php">Vendors</a>
    <a href="venue.php">Venue</a>
    <a href="ecard.php">E-cards</a>
    <a href="contact.php">Contact</a>
    <?php if (isset($_SESSION['email'])): ?>
      <a href="logout.php"><button class="btn1">Logout</button></a>
    <?php else: ?>
      <a href="login.php"><button class="btn1">Login</button></a>
    <?php endif; ?>
  </nav>
</header>

<!-- Venue List Section -->
<section class="venue-list" style="padding:20px;">
  <h1 style="text-align:center; margin-bottom:30px;">Venues</h1>
  <div class="venue-container" style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">
    <?php while ($venue = $result->fetch_assoc()): ?>
      <div class="venue-box" style="width:45%; border-radius:10px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.1); cursor:pointer;">
        <a href="book_venue.php?venue_id=<?= $venue['id'] ?>">
          <img src="Image/<?= htmlspecialchars($venue['image']) ?>" alt="<?= htmlspecialchars($venue['name']) ?>" style="width:100%; display:block; border-bottom:1px solid #ddd;">
        </a>
        <div style="padding:15px;">
          <h3><?= htmlspecialchars($venue['name']) ?></h3>
          <p><?= htmlspecialchars($venue['description']) ?></p>
          <p><strong>Price:</strong> ৳<?= htmlspecialchars($venue['price']) ?></p>
          <a href="book_venue.php?venue_id=<?= $venue['id'] ?>">
            <button class="btn" style="margin-top:10px; width:100%;">Book this Venue</button>
          </a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

</body>
</html>
