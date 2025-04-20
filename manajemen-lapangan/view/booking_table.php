<?php
// Tabel Bookings dengan pencarian
function renderBookingTable($bookings, $search = '') {
    echo '<form class="row mb-2" method="get"><input type="hidden" name="page" value="bookings">';
    echo '<div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Cari nama user/lapangan..." value="'.htmlspecialchars($search).'"></div>';
    echo '<div class="col-md-2"><button class="btn btn-primary" type="submit">Search</button></div>';
    echo '</form>';
    echo '<a href="index.php?page=add_booking" class="btn btn-success mb-2">Add Booking</a>';
    echo '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>User</th><th>Field</th><th>Date</th><th>Time Slot</th><th>Status</th><th>Action</th></tr></thead><tbody>';
    foreach ($bookings as $b) {
        echo '<tr><td>'.$b['id'].'</td><td>'.$b['user_name'].'</td><td>'.$b['field_name'].'</td><td>'.$b['booking_date'].'</td><td>'.$b['time_slot'].'</td><td>'.$b['status'].'</td>';
        echo '<td><a href="index.php?page=edit_booking&id='.$b['id'].'" class="btn btn-warning btn-sm">Edit</a> ';
        echo '<a href="index.php?page=delete_booking&id='.$b['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Delete booking?\')">Delete</a></td></tr>';
    }
    echo '</tbody></table>';
}
?>
