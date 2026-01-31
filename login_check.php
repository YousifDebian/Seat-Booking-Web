<?php 
session_start(); 
include "db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    
    echo 
    "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body style='background-color: #f3f4f6; font-family: sans-serif;'></body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Welcome Back, " . $row['username'] . "!',
            text: 'Redirecting to dashboard...',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
    </script>";
    exit();

} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body style='background-color: #f3f4f6; font-family: sans-serif;'></body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Incorrect Username or Password',
            confirmButtonText: 'Try Again',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit();
}
} else {
    header("Location: home.php");
    exit();
}