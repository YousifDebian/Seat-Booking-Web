<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $seat_number = mysqli_real_escape_string($conn, $_POST['seat_number']);

    if (empty($seat_number)) {
        echo "<script>alert('Please select a seat first!'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO Booking (full_name, phone, email, gender, address, notes, seat_number) 
            VALUES ('$full_name', '$phone', '$email', '$gender', '$address', '$notes', '$seat_number')";

    try {
        if (mysqli_query($conn, $sql)) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <body style='background-color: #f3f4f6; font-family: sans-serif;'></body>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Booked Successfully!',
                text: 'Seat ($seat_number) saved to system.',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'home.php';
            });
        </script>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script>alert('Sorry! This seat ($seat_number) was just booked by someone else.'); window.location.href='register.php';</script>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>