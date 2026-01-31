<?php 
session_start();
include "db.php"; 

if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}

$total_seats = 60; 

$sql_count = "SELECT COUNT(*) as total_booked FROM Booking";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$booked_count = $row_count['total_booked'];

$available_seats = $total_seats - $booked_count;

$sql_bookings = "SELECT * FROM Booking ORDER BY id DESC";
$result_bookings = mysqli_query($conn, $sql_bookings);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style=2.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-layout">
        
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <i class="fas fa-ticket-alt" style="color: #3b82f6;"></i> PANAL
            </div>
            <ul>
                <li class="active"><a href="#"><i class="fas fa-home"></i> Overview</a></li>
                <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <div class="dashboard-content">
            
            <div class="header">
                <div class="page-title" onclick="toggleSidebar()" style="display:flex; align-items:center; gap:15px;">
                    <i class="fas fa-home home-logo" style="cursor:pointer; font-size:20px; color:#374151;"></i>
                    <h2>Overview</h2>
                </div>
                <div class="user-info">
                    <span>Hello, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?></span>
                    <i class="fas fa-user-circle" style="font-size:24px; color:#9ca3af;"></i>
                </div>
            </div>

            <div class="stats-grid">
                
                <div class="stat-card">
                    <span class="status-dot dot-yellow"></span>
                    <p>Total Seats</p>
                    <h3><?php echo $total_seats; ?></h3>
                </div>

                <div class="stat-card">
                    <span class="status-dot dot-green dot"></span>
                    <p>Available Seats</p>
                    <h3><?php echo $available_seats; ?></h3>
                </div>

                <div class="stat-card">
                    <span class="status-dot dot-red dot"></span>
                    <p>Booked Seats</p>
                    <h3><?php echo $booked_count; ?></h3>
                </div>

            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3>All Bookings</h3>
                    <span>List of recent ticket reservations</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Phone Number</th>
                            <th>Seat</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        if (mysqli_num_rows($result_bookings) > 0) {
                            while($row = mysqli_fetch_assoc($result_bookings)) { 
                        ?>
                        
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            
                            <td style="font-weight: bold;">
                                <?php echo htmlspecialchars($row['full_name']); ?>
                            </td>
                            
                            <td><?php echo $row['phone']; ?></td>
                            
                            <td>
                                <span class="seat-badge"><?php echo $row['seat_number']; ?></span>
                            </td>

                            <td>
                                <?php if($row['status'] == 'confirmed'): ?>
                                    <span style="color:#10b981; font-weight:600; font-size:13px;">Confirmed</span>
                                <?php else: ?>
                                    <span style="color:#ef4444; font-weight:600; font-size:13px;">Canceled</span>
                                <?php endif; ?>
                            </td>

                            <td style="text-align:right;">
                                <a href="delete_booking.php?id=<?php echo $row['id']; ?>" 
                                   class="delete-icon" 
                                   onclick="return confirm('Delete this booking permanently?')">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                        <?php 
                            } 
                        } else { 
                            echo "<tr><td colspan='6' style='text-align:center; padding:30px; color:#9ca3af;'>No bookings found.</td></tr>"; 
                        } 
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
   <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hide');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>