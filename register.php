<?php 
include "db.php"; 

$query = "SELECT seat_number FROM Booking WHERE status = 'confirmed'";
$result = mysqli_query($conn, $query);

$bookedSeatsArray = [];
while($row = mysqli_fetch_assoc($result)) {
    $bookedSeatsArray[] = $row['seat_number'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Seat</title>
    <link rel="stylesheet" href="style=2.css">
</head>
<body>

    <div class="main-container">
        <div class="form-section">
            <h2 style="margin-bottom:10px;"><a href="home.php" style="text-decoration:none; color:inherit; margin-right:10px">&#8592;</a> Apply Form</h2>
            <form action="book.php" method="POST">
                <label>Full Name</label>
                <input type="text" name="full_name" required placeholder="Enter full name">

                <label>Phone Number</label>
                <input type="text" name="phone" required placeholder="01xxxxxxxxx">

                <label>Email Address</label>
                <input type="email" name="email" required placeholder="example@mail.com">

                <label>Gender</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <label>Address</label>
                <input type="text" name="address" required placeholder="City, Area...">

                <label>Additional Notes</label>
                <textarea name="notes" placeholder="Any details..."></textarea>

                <input type="hidden" id="selected_seat_input" name="seat_number" required>

                <button type="submit" class="submit-btn">Confirm Booking</button>
            </form>
        </div>

        <div class="seats-section">
            <h2>Select Seat</h2>
            <div class="screen">STAGE</div>
            
            <div class="seats-grid" id="seatsContainer"></div>

            <p style="margin-top: 20px;">Selected Seat: <span id="displaySeat" style="font-weight:bold; color:#4a90e2; font-size:18px;">None</span></p>
        </div>
    </div>

    <script>
        window.bookedSeatsFromDB = <?php echo json_encode($bookedSeatsArray); ?>;
    </script>
    
    <script src="script.js"></script>

</body>
</html>