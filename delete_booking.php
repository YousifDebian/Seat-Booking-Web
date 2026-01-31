<?php
include('db.php');

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $delete = "DELETE FROM booking WHERE id = $id";

    if (mysqli_query($conn, $delete)) {

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='background-color: #f3f4f6; font-family: sans-serif;'></body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted Successfully!',
                text: 'Appointment deleted from system.',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'dashboard.php';
            });
        </script>";
        exit();

    } else {
        echo "Error";
    }
}
?>
