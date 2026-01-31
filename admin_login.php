<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style=2.css">
</head>
<body>

    <div class="container" style="max-width: 400px;">
        <h2>Admin Login</h2>
        
        <form action="login_check.php" method="post">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Enter username">

            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter password">

            <button type="submit" class="submit-btn">Login</button>
            
            <div style="text-align: center; margin-top: 15px;">
                <a href="home.php" style="text-decoration: none; color: #666; font-size: 14px;">Back to Home</a>
            </div>
        </form>
    </div>

</body>
</html>